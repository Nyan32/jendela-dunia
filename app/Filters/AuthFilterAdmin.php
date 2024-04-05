<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilterAdmin implements FilterInterface
{
    public function __construct()
    {
        $this->session = session();
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        $account = $this->session->get('AdminLogin');
        if ($account == null && $account == '') {
            $this->session->setFlashdata('errorRes', array('account' => 'Please login first.'));
            return redirect()->to(base_url('admin'));
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
