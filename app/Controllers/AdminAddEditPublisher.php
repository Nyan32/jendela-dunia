<?php

namespace App\Controllers;

use App\Models\Publisher;

class AdminAddEditPublisher extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->publisherTable = new Publisher();
        $this->session = session();
    }
    public function showpage($id = '')
    {
        if ($id != '') {
            $publisherData = $this->publisherTable->where('id', $id)->findAll();
            $data['publisherData'] = $publisherData;
        } else {
            $data['publisherData'] = null;
        }

        $data['errorRes'] = $this->session->getFlashdata('errorRes');
        $data['lastInputData'] = $this->session->getFlashdata('lastInputData');

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/addeditpublisher', $data);
    }

    public function addeditpublisher()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $verif_data = [
                'name' => trim(strip_tags($this->request->getPost('name'))),
                'address' => trim(strip_tags($this->request->getPost('address'))),
                'imagePublisher' => $this->request->getFile('imagePublisher')
            ];

            $this->session->setFlashdata('lastInputData', array(
                'name' => $this->request->getPost('name'),
                'address' => $this->request->getPost('address')
            ));

            if ($this->validation->run($verif_data, 'addpublisher') == FALSE) {
                $this->session->setFlashdata('errorRes', $this->validation->getErrors());
                if (isset($id)) {
                    return redirect()->to(base_url('admin/addeditpublisher/' . $id));
                } else {
                    return redirect()->to(base_url('admin/addeditpublisher'));
                }
            } else {
                $imageStatus = $this->request->getPost('imageStatus');
                if ($imageStatus != 'add' && $imageStatus != 'delete' && $imageStatus != 'keep') {
                    $this->session->setFlashdata('errorRes', array('image' => 'Image input is invalid.'));
                } else {
                    if (isset($id)) {
                        if ($imageStatus == 'keep') {
                            $this->publisherTable->update($id, ['name' => $verif_data['name'], 'address' => $verif_data['address']]);

                            return redirect()->to(base_url('admin/addeditpublisher/' . $id));
                        } else if ($imageStatus == 'add') {
                            $ext = $verif_data['imagePublisher']->getClientExtension();
                            $filename = $verif_data['imagePublisher']->getFilename();

                            if ($filename == '') {
                                $prevImgName = $this->publisherTable->select('image')->where('id', $id)->findAll();
                                if ($prevImgName[0]['image'] != 'no-image.png') {
                                    unlink('./administrator/image_upload/penerbit/' . $prevImgName[0]['image']);
                                }

                                $this->publisherTable->update($id, ['name' => $verif_data['name'], 'address' => $verif_data['address'], 'image' => 'no-image.png']);

                                return redirect()->to(base_url('admin/addeditpublisher/' . $id));
                            } else {
                                $prevImgName = $this->publisherTable->select('image')->where('id', $id)->findAll();
                                if ($prevImgName[0]['image'] != 'no-image.png') {
                                    unlink('./administrator/image_upload/penerbit/' . $prevImgName[0]['image']);
                                }

                                $this->publisherTable->update($id, ['name' => $verif_data['name'], 'address' => $verif_data['address'], 'image' => 'tmp']);

                                $filename = 'penerbit-' . $id . '.' . $ext;
                                $this->publisherTable->update($id, ['image' => $filename]);

                                if ($verif_data['imagePublisher']->isValid() && !$verif_data['imagePublisher']->hasMoved()) {
                                    $verif_data['imagePublisher']->move('administrator/image_upload/penerbit', $filename);
                                }
                                return redirect()->to(base_url('admin/addeditpublisher/' . $id));
                            }
                        } else {
                            $prevImgName = $this->publisherTable->select('image')->where('id', $id)->findAll();
                            if ($prevImgName[0]['image'] != 'no-image.png') {
                                unlink('./administrator/image_upload/penerbit/' . $prevImgName[0]['image']);
                            }

                            $this->publisherTable->update($id, ['name' => $verif_data['name'], 'address' => $verif_data['address'], 'image' => 'no-image.png']);

                            return redirect()->to(base_url('admin/addeditpublisher/' . $id));
                        }
                    } else {
                        if ($imageStatus == 'add' || $imageStatus == 'keep') {
                            $ext = $verif_data['imagePublisher']->getClientExtension();
                            $filename = $verif_data['imagePublisher']->getFilename();

                            if ($filename == '') {
                                $this->publisherTable->insert(['name' => $verif_data['name'], 'address' => $verif_data['address'], 'image' => 'no-image.png']);
                                return redirect()->to(base_url('admin/publishers'));
                            } else {
                                $id = $this->publisherTable->insert(['name' => $verif_data['name'], 'address' => $verif_data['address'], 'image' => 'tmp']);

                                $filename = 'penerbit-' . $id . '.' . $ext;
                                $this->publisherTable->update($id, ['image' => $filename]);

                                if ($verif_data['imagePublisher']->isValid() && !$verif_data['imagePublisher']->hasMoved()) {
                                    $verif_data['imagePublisher']->move('administrator/image_upload/penerbit', $filename);
                                }
                                return redirect()->to(base_url('admin/publishers'));
                            }
                        } else {
                            $this->publisherTable->insert(['name' => $verif_data['name'], 'address' => $verif_data['address'], 'image' => 'no-image.png']);

                            return redirect()->to(base_url('admin/publishers'));
                        }
                    }
                }
            }
        }
    }
}
