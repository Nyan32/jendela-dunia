<?php

namespace App\Filters;

use App\Models\User;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function __construct()
    {
        $this->userTable = new User();
        $this->session = session();
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        $account = $this->session->get('LoggedIn');
        if ($account == null && $account == '') {
            $this->session->setFlashdata('errorRes', 'Please log in first.');
            return redirect()->to(base_url('loginreg'));
        } else {
            $user = $this->userTable->select('status')->where('email', $account)->findAll();
            if (count($user) <= 0) {
                $this->session->setFlashdata('errorRes', 'Account is not found.');
                return redirect()->to(base_url('loginreg'));
            } else {
                if ($user[0]['status'] == 'disable') {
                    $this->session->setFlashdata('errorRes', 'Your account is disabled. Please contact administrator.');
                    return redirect()->to(base_url('loginreg'));
                }
            }
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
