<?php

namespace App\Controllers;

use App\Models\Administrator;

class AdminLogin extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->validation = \Config\Services::validation();
        $this->adminTable = new Administrator();
    }
    public function showpage()
    {
        $this->session->set('AdminLogin', '');
        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        $data['errorRes'] = $this->session->getFlashdata('errorRes');

        return view('adminpage/adminlogin', $data);
    }

    public function verifylogin()
    {
        $this->data = array('token' => null);

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getPost('method') === 'login') {
                $verif_data = [
                    'emailLogin' => strtolower(trim(strip_tags($this->request->getPost('emailLogin')))),
                    'passwordLogin' => strip_tags($this->request->getPost('passwordLogin'))
                ];

                if ($this->validation->run($verif_data, 'login') == FALSE) {
                    $this->session->setFlashdata('errorRes', $this->validation->getErrors());
                    return redirect()->to(base_url('admin'));
                } else {
                    $adminCount = $this->adminTable->where('email', $verif_data['emailLogin'])->where('password', $verif_data['passwordLogin'])->select('email')->findAll();

                    if (count($adminCount) > 0) {
                        $this->session->set('AdminLogin', $adminCount[0]['email']);
                        return redirect()->to(base_url('admin/books'));
                    } else {
                        $this->session->setFlashdata('errorRes', array('account' => 'Email or password is incorrect'));
                        return redirect()->to(base_url('admin'));
                    }
                }
            }
        }
    }
}
