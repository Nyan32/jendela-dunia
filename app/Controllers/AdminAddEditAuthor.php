<?php

namespace App\Controllers;

use App\Models\Author;

class AdminAddEditAuthor extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->authorTable = new Author();
        $this->session = session();
    }
    public function showpage($id = '')
    {
        if ($id != '') {
            $authorData = $this->authorTable->where('id', $id)->findAll();
            $data['authorData'] = $authorData;
        } else {
            $data['authorData'] = null;
        }

        $data['errorRes'] = $this->session->getFlashdata('errorRes');
        $data['lastInputData'] = $this->session->getFlashdata('lastInputData');

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/addeditauthor', $data);
    }

    public function addeditauthor()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $verif_data = [
                'name' => trim(strip_tags($this->request->getPost('name'))),
                'birthdate' => trim(strip_tags($this->request->getPost('birthdate'))),
                'imageAuthor' => $this->request->getFile('imageAuthor')
            ];

            $this->session->setFlashdata('lastInputData', array(
                'name' => $this->request->getPost('name'),
                'birthdate' => $this->request->getPost('birthdate')
            ));

            if ($this->validation->run($verif_data, 'addauthor') == FALSE) {
                $this->session->setFlashdata('errorRes', $this->validation->getErrors());
                if (isset($id)) {
                    return redirect()->to(base_url('admin/addeditauthor/' . $id));
                } else {
                    return redirect()->to(base_url('admin/addeditauthor'));
                }
            } else {
                $imageStatus = $this->request->getPost('imageStatus');
                if ($imageStatus != 'add' && $imageStatus != 'delete' && $imageStatus != 'keep') {
                    $this->session->setFlashdata('errorRes', array('image' => 'Image input is invalid.'));
                } else {
                    if (isset($id)) {
                        if ($imageStatus == 'keep') {
                            $this->authorTable->update($id, ['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate']]);

                            return redirect()->to(base_url('admin/addeditauthor/' . $id));
                        } else if ($imageStatus == 'add') {
                            $ext = $verif_data['imageAuthor']->getClientExtension();
                            $filename = $verif_data['imageAuthor']->getFilename();

                            if ($filename == '') {
                                $prevImgName = $this->authorTable->select('image')->where('id', $id)->findAll();
                                if ($prevImgName[0]['image'] != 'no-image.png') {
                                    unlink('./administrator/image_upload/penulis/' . $prevImgName[0]['image']);
                                }

                                $this->authorTable->update($id, ['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate'], 'image' => 'no-image.png']);

                                return redirect()->to(base_url('admin/addeditauthor/' . $id));
                            } else {
                                $prevImgName = $this->authorTable->select('image')->where('id', $id)->findAll();
                                if ($prevImgName[0]['image'] != 'no-image.png') {
                                    unlink('./administrator/image_upload/penulis/' . $prevImgName[0]['image']);
                                }

                                $this->authorTable->update($id, ['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate'], 'image' => 'tmp']);

                                $filename = 'penulis-' . $id . '.' . $ext;
                                $this->authorTable->update($id, ['image' => $filename]);

                                if ($verif_data['imageAuthor']->isValid() && !$verif_data['imageAuthor']->hasMoved()) {
                                    $verif_data['imageAuthor']->move('administrator/image_upload/penulis', $filename);
                                }
                                return redirect()->to(base_url('admin/addeditauthor/' . $id));
                            }
                        } else {
                            $prevImgName = $this->authorTable->select('image')->where('id', $id)->findAll();
                            if ($prevImgName[0]['image'] != 'no-image.png') {
                                unlink('./administrator/image_upload/penulis/' . $prevImgName[0]['image']);
                            }

                            $this->authorTable->update($id, ['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate'], 'image' => 'no-image.png']);

                            return redirect()->to(base_url('admin/addeditauthor/' . $id));
                        }
                    } else {
                        if ($imageStatus == 'add' || $imageStatus == 'keep') {
                            $ext = $verif_data['imageAuthor']->getClientExtension();
                            $filename = $verif_data['imageAuthor']->getFilename();

                            if ($filename == '') {
                                $this->authorTable->insert(['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate'], 'image' => 'no-image.png']);
                                return redirect()->to(base_url('admin/authors'));
                            } else {
                                $id = $this->authorTable->insert(['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate'], 'image' => 'tmp']);

                                $filename = 'penulis-' . $id . '.' . $ext;
                                $this->authorTable->update($id, ['image' => $filename]);

                                if ($verif_data['imageAuthor']->isValid() && !$verif_data['imageAuthor']->hasMoved()) {
                                    $verif_data['imageAuthor']->move('administrator/image_upload/penulis', $filename);
                                }
                                return redirect()->to(base_url('admin/authors'));
                            }
                        } else {
                            $this->authorTable->insert(['name' => $verif_data['name'], 'birthdate' => $verif_data['birthdate'], 'image' => 'no-image.png']);

                            return redirect()->to(base_url('admin/authors'));
                        }
                    }
                }
            }
        }
    }
}
