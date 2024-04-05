<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;
use App\Models\Book_Borrow;
use App\Models\Book_Genre;
use App\Models\Book_Like;

class AdminIndex extends BaseController
{
    public function __construct()
    {
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->bookBorrowTable = new Book_Borrow();
        $this->bookGenreTable = new Book_Genre();
        $this->bookLikeTable = new Book_Like();
        $this->session = session();
    }
    public function showpage()
    {
        $books = $this->bookTable->orderBy('title', 'ASC')->findAll();
        $data['bookData'] = $books;
        for ($i = 0; $i < count($data['bookData']); $i++) {
            $author = $this->bookAuthorTable->select('name')->join('author', 'book_author.author_id = author.id')->where('book_author.book_id = ' . $data['bookData'][$i]['id'])->find();

            $data['bookData'][$i]['author'] = $author;

            $publisher = $this->bookTable->select('publisher.name')->join('publisher', 'book.publisher_id = publisher.id')->where('book.id = ' . $data['bookData'][$i]['id'])->find();

            $data['bookData'][$i]['publisher'] = $publisher;
        }

        $data['errorRes'] = $this->session->getFlashdata('errorRes');

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/books', $data);
    }
    public function deletebook()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $notReturnCount = $this->bookBorrowTable->where('book_id', $id)->where('status', 'NOT RETURNED')->findAll();

            if (count($notReturnCount) <= 0) {
                $prevImgName = $this->bookTable->select('image')->where('id', $id)->findAll();
                if ($prevImgName[0]['image'] != 'no-image.png') {
                    unlink('./administrator/image_upload/buku/' . $prevImgName[0]['image']);
                }
                $this->bookTable->where('id', $id)->delete();
                $this->bookAuthorTable->where('book_id', $id)->delete();
                $this->bookBorrowTable->where('book_id', $id)->delete();
                $this->bookGenreTable->where('book_id', $id)->delete();
                $this->bookLikeTable->where('book_id', $id)->delete();
            } else {
                $data['errorRes'] = $this->session->setFlashdata('errorRes', array('error' => 'Not all book is returned.'));
            }


            return redirect()->to(base_url('admin/books'));
        }
    }
}
