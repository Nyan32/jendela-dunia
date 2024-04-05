<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AdminUser extends BaseController
{
    public function __construct()
    {
        $this->userTable = new User();
        $this->session = session();
    }
    public function showpage()
    {
        $userData = $this->userTable->orderBy('email', 'ASC')->findAll();
        $data['userData'] = $userData;

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/users', $data);
    }
    public function controluser()
    {
        $email = $this->request->getPost('email');
        $userStatus = $this->userTable->where('email', $email)->findAll();

        if (count($userStatus) > 0) {
            if ($userStatus[0]['status'] == 'disable') {
                $this->userTable->set('status', 'enable')->where('email', $email)->update();
            } else if ($userStatus[0]['status'] == 'enable') {
                $this->userTable->set('status', 'disable')->where('email', $email)->update();
            }
        }
        return redirect()->to(base_url('admin/users'));
    }
    public function resetpass()
    {
        $email = $this->request->getPost('email');
        $this->userTable->where('email', $email)->set('password', 'jendeladunia')->update();
        return redirect()->to(base_url('admin/users'));
    }
}
