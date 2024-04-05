<?php

namespace App\Controllers;

use App\Models\User;

class LoginRegister extends BaseController
{
    public function __construct()
    {
        $this->userTable = new User();
        $this->session = session();
    }
    public function showpage()
    {
        $this->session->set('LoggedIn', '');
        $account = $this->session->get('LoggedIn');
        if ($account != null && $account != '') {
            $data['LoggedIn'] = $account;
        } else {
            $data['LoggedIn'] = null;
        }

        $data['errorRes'] = $this->session->getFlashData('errorRes');

        return view('page/loginreg', $data);
    }
}
