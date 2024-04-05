<?php

namespace App\Controllers;

use App\Models\Genre;

class AdminAddEditGenre extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->genreTable = new Genre();
        $this->session = session();
    }
    public function showpage($id = '')
    {
        if ($id != '') {
            $genreData = $this->genreTable->where('id', $id)->findAll();
            $data['genreData'] = $genreData;
        } else {
            $data['genreData'] = null;
        }

        $data['errorRes'] = $this->session->getFlashdata('errorRes');
        $data['lastInputData'] = $this->session->getFlashdata('lastInputData');

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/addeditgenre', $data);
    }

    public function addeditgenre()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $verif_data = [
                'name' => trim(strip_tags($this->request->getPost('name')))
            ];

            $this->session->setFlashdata('lastInputData', array(
                'name' => $this->request->getPost('name')
            ));

            if ($this->validation->run($verif_data, 'addgenre') == FALSE) {
                $this->session->setFlashdata('errorRes', $this->validation->getErrors());
                if (isset($id)) {
                    return redirect()->to(base_url('admin/addeditgenre/' . $id));
                } else {
                    return redirect()->to(base_url('admin/addeditgenre'));
                }
            } else {
                if (isset($id)) {
                    $this->genreTable->where('id', $id)->set('name', $verif_data['name'])->update();
                    return redirect()->to(base_url('admin/addeditgenre/' . $id));
                } else {
                    $this->genreTable->insert(['name' => $verif_data['name']]);
                    return redirect()->to(base_url('admin/genres'));
                }
            }
        }
    }
}
