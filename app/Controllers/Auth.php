<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\User_Detail;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userTable = new User();
        $this->userDetailTable = new User_Detail();
        $this->session = session();
    }
    public function verify()
    {
        $this->data = array('token' => null, 'errorRes' => null);

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getPost('method') === 'login') {
                $verif_data = [
                    'emailLogin' => strtolower(trim(strip_tags($this->request->getPost('emailLogin')))),
                    'passwordLogin' => strip_tags($this->request->getPost('passwordLogin'))
                ];

                if ($this->validation->run($verif_data, 'login') == FALSE) {
                    $this->data['errorRes'] = $this->validation->getErrors();
                } else {
                    $user = $this->userTable->where('email', $verif_data['emailLogin'])->where('password', $verif_data['passwordLogin'])->select('email, status')->findAll();

                    if (count($user) > 0) {
                        if ($user[0]['status'] == 'enable') {
                            $this->session->set('LoggedIn', $user[0]['email']);
                        } else if ($user[0]['status'] == 'disable') {
                            $this->data['errorRes'] = array('account' => 'Your account is disabled. Please contact administrator.');
                        }
                    } else {
                        $this->data['errorRes'] = array('account' => 'Email or password is incorrect');
                    }
                }
            } else if ($this->request->getPost('method') === 'register') {
                $verif_data = [
                    'name' => trim(strip_tags($this->request->getPost('name'))),
                    'gender' => trim(strip_tags($this->request->getPost('gender'))),
                    'birthdate' => trim(strip_tags($this->request->getPost('birthdate'))),
                    'phone' => trim(strip_tags($this->request->getPost('phone'))),
                    'address' => trim(strip_tags($this->request->getPost('address'))),
                    'emailReg' => strtolower(trim(strip_tags($this->request->getPost('emailReg')))),
                    'passwordReg' => trim(strip_tags($this->request->getPost('passwordReg'))),
                    'confPassword' => trim(strip_tags($this->request->getPost('confPassword')))
                ];

                if ($this->validation->run($verif_data, 'register') == FALSE) {
                    $this->data['errorRes'] = $this->validation->getErrors();
                } else {
                    $userCount = $this->userTable->where('email', $verif_data['emailReg'])->select('email')->findAll();

                    if (count($userCount) == 0) {
                        $this->userTable->insert(['email' => $verif_data['emailReg'], 'password' => $verif_data['passwordReg'], 'status' => 'enable']);
                        $this->userDetailTable->insert(['name' => $verif_data['name'], 'gender' => $verif_data['gender'], 'birthdate' => $verif_data['birthdate'], 'phone' => $verif_data['phone'], 'address' => $verif_data['address'], 'email' => $verif_data['emailReg'], 'fine' => 0]);
                    } else {
                        $this->data['errorRes'] = array('account' => 'Email had been already registered');
                    }
                }
            }
        }
        $this->data['token'] = csrf_hash();
        echo json_encode($this->data);
    }

    public function editprofile()
    {
        if ($this->request->getMethod() == 'post') {
            $verif_data = [
                'name' => trim(strip_tags($this->request->getPost('name'))),
                'gender' => trim(strip_tags($this->request->getPost('gender'))),
                'birthdate' => trim(strip_tags($this->request->getPost('birthdate'))),
                'phone' => trim(strip_tags($this->request->getPost('phone'))),
                'address' => trim(strip_tags($this->request->getPost('address'))),
                'emailReg' => strtolower(trim(strip_tags($this->request->getPost('emailReg')))),
                'passwordReg' => trim(strip_tags($this->request->getPost('passwordReg'))),
                'confPassword' => trim(strip_tags($this->request->getPost('confPassword')))
            ];

            if ($this->validation->run($verif_data, 'register') == FALSE) {
                $this->session->setFlashdata('errorRes', $this->validation->getErrors());
            } else {
                $userCount = $this->userTable->where('email', $verif_data['emailReg'])->where('email != "' . $this->session->get('LoggedIn') . '"')->select('email')->findAll();

                if (count($userCount) == 0) {
                    $this->userTable->update($this->session->get('LoggedIn'), ['email' => $verif_data['emailReg'], 'password' => $verif_data['passwordReg']]);

                    $this->userDetailTable->update($this->session->get('LoggedIn'), ['email' => $verif_data['emailReg'], 'name' => $verif_data['name'], 'gender' => $verif_data['gender'], 'birthdate' => $verif_data['birthdate'], 'phone' => $verif_data['phone'], 'address' => $verif_data['address']]);

                    $this->session->set('LoggedIn', $verif_data['emailReg']);
                } else {
                    $this->session->setFlashdata('errorRes', array('account' => 'Email had been already registered'));
                }
            }

            if ($this->session->getFlashdata('errorRes') == null) {
                return redirect()->to(base_url('profile'));
            } else {
                return redirect()->to(base_url('profile/showedit'));
            }
        }
    }
}
