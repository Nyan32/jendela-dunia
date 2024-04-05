<?php

namespace App\Controllers;

use App\Models\User_Detail;
use App\Models\Book;
use App\Models\Book_Author;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userDetailTable = new User_Detail();
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->session = session();
    }
    public function showpage()
    {
        $userData = $this->userDetailTable->select('name, phone, address, fine, gender, birthdate')->where('email', $this->session->get('LoggedIn'))->findAll();

        $email = $this->session->get('LoggedIn');

        $data['userData'] = $userData;
        $data['errorRes'] = $this->session->getFlashdata('errorRes');

        $books = $this->bookTable->select('book.*')->join('book_borrow', 'book_borrow.book_id = book.id')->join('user', 'book_borrow.user_email = user.email')->where('book_borrow.user_email', $email)->where('book_borrow.status', 'NOT RETURNED')->findAll();
        $data['bookData'] = $books;
        for ($i = 0; $i < count($data['bookData']); $i++) {
            $author = $this->bookAuthorTable->select('name')->join('author', 'book_author.author_id = author.id')->where('book_author.book_id = ' . $data['bookData'][$i]['id'])->find();

            $data['bookData'][$i]['author'] = $author;

            $publisher = $this->bookTable->select('publisher.name')->join('publisher', 'book.publisher_id = publisher.id')->where('book.id = ' . $data['bookData'][$i]['id'])->find();

            $data['bookData'][$i]['publisher'] = $publisher;
        }

        $account = $this->session->get('LoggedIn');
        if ($account != null && $account != '') {
            $data['LoggedIn'] = $account;
        } else {
            $data['LoggedIn'] = null;
        }

        return view('page/profile', $data);
    }

    public function payfine()
    {
        if ($this->request->getMethod() == 'post') {
            $verif_data = [
                'payment' => trim(strip_tags($this->request->getPost('payment')))
            ];

            if ($this->validation->run($verif_data, 'payment') == FALSE) {
                $this->session->setFlashdata('errorRes', $this->validation->getErrors());
            } else {
                $fine = $this->userDetailTable->select('fine')->where('email', $this->session->get('LoggedIn'))->findAll();

                if ($verif_data['payment'] < $fine[0]['fine']) {
                    $result = $fine[0]['fine'] - $verif_data['payment'];
                } else {
                    $result = 0;
                }

                $this->userDetailTable->update($this->session->get('LoggedIn'), [
                    'fine' => $result
                ]);
            }

            return redirect()->to(base_url('profile'));
        }
    }

    public function showedit()
    {
        $data['errorRes'] = $this->session->getFlashData('errorRes');

        $userData = $this->userDetailTable->select('user_detail.name, user_detail.phone, user_detail.address, user_detail.gender, user_detail.birthdate, user.email, user.password')->join('user', 'user.email = user_detail.email')->where('user.email', $this->session->get('LoggedIn'))->findAll();
        $data['userData'] = $userData;

        $account = $this->session->get('LoggedIn');
        if ($account != null && $account != '') {
            $data['LoggedIn'] = $account;
        } else {
            $data['LoggedIn'] = null;
        }

        return view('page/editprofile', $data);
    }
}
