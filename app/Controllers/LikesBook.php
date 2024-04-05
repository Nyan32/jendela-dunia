<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;

class LikesBook extends BaseController
{
    public function __construct()
    {
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->session = session();
    }
    public function showpage()
    {
        $email = $this->session->get('LoggedIn');
        $books = $this->bookTable->select('book.*')->join('book_like', 'book_like.book_id = book.id')->join('user', 'book_like.user_email = user.email')->where('book_like.user_email', $email)->orderBy('book.title', 'ASC')->findAll();
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

        return view('page/likes', $data);
    }
}
