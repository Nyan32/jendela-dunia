<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;

class AboutUs extends BaseController
{
    public function __construct()
    {
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->session = session();
    }
    public function showpage()
    {
        $account = $this->session->get('LoggedIn');
        if ($account != null && $account != '') {
            $data['LoggedIn'] = $account;
        } else {
            $data['LoggedIn'] = null;
        }

        return view('page/aboutus', $data);
    }
}
