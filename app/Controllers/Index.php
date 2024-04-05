<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;

class Index extends BaseController
{
    public function __construct()
    {
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
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

        $account = $this->session->get('LoggedIn');
        if ($account != null && $account != '') {
            $data['LoggedIn'] = $account;
        } else {
            $data['LoggedIn'] = null;
        }

        return view('page/index', $data);
    }
}
