<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;
use App\Models\Publisher;
use App\Models\Author;

class SearchItem extends BaseController
{
    public function __construct()
    {
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->authorTable = new Author();
        $this->publisherTable = new Publisher();
        $this->session = session();
    }

    public function search()
    {
        if ($this->request->getMethod() == 'get') {
            $searchItem = trim($this->request->getGet('searchItem'));
            $sort1 = trim($this->request->getGet('sort1'));
            $sort2 = trim($this->request->getGet('sort2'));

            if ($searchItem != '') {
                $allData = $this->bookTable->distinct()->select('book.id')->join('book_author', 'book.id = book_author.book_id', 'left')->join('author', 'book_author.author_id = author.id', 'left')->join('publisher', 'book.publisher_id = publisher.id', 'left')->where('book.title LIKE \'%' . $searchItem . '%\' OR author.name LIKE \'%' . $searchItem . '%\' OR publisher.name LIKE \'%' . $searchItem . '%\' ')->orderBy($sort2, $sort1)->findAll();
            } else {
                $allData = $this->bookTable->distinct()->select('book.id')->join('book_author', 'book.id = book_author.book_id', 'left')->join('author', 'book_author.author_id = author.id', 'left')->join('publisher', 'book.publisher_id = publisher.id', 'left')->orderBy($sort2, $sort1)->findAll();
            }

            $data['book'] = null;

            for ($i = 0; $i < count($allData); $i++) {
                $data['book'][$i] = $this->bookTable->select()->where('id', $allData[$i]['id'])->find();

                $author = $this->bookAuthorTable->select('name')->join('author', 'book_author.author_id = author.id')->where('book_author.book_id = ' . $allData[$i]['id'])->find();

                $data['book'][$i][0]['author'] = $author;

                $publisher = $this->bookTable->select('publisher.name')->join('publisher', 'book.publisher_id = publisher.id')->where('book.id = ' . $allData[$i]['id'])->find();

                $data['book'][$i][0]['publisher'] = $publisher;
            }
            $data['token'] = csrf_hash();
            echo json_encode($data);
        }
    }

    public function bylikes()
    {
        if ($this->request->getMethod() == 'get') {
            $searchItem = trim($this->request->getGet('searchItem'));
            $sort1 = trim($this->request->getGet('sort1'));
            $sort2 = trim($this->request->getGet('sort2'));
            $email = $this->session->get('LoggedIn');

            if ($searchItem != '') {
                $allData = $this->bookTable->distinct()->select('book.id')->join('book_like', 'book_like.book_id = book.id')->join('user', 'book_like.user_email = user.email')->where('user.email', $email)->join('book_author', 'book.id = book_author.book_id', 'left')->join('author', 'book_author.author_id = author.id', 'left')->join('publisher', 'book.publisher_id = publisher.id', 'left')->where('book.title LIKE \'%' . $searchItem . '%\' OR author.name LIKE \'%' . $searchItem . '%\' OR publisher.name LIKE \'%' . $searchItem . '%\' ')->orderBy($sort2, $sort1)->findAll();
            } else {
                $allData = $this->bookTable->distinct()->select('book.id')->join('book_like', 'book_like.book_id = book.id')->join('user', 'book_like.user_email = user.email')->where('user.email', $email)->join('book_author', 'book.id = book_author.book_id', 'left')->join('author', 'book_author.author_id = author.id', 'left')->join('publisher', 'book.publisher_id = publisher.id', 'left')->orderBy($sort2, $sort1)->findAll();
            }

            $data['book'] = null;

            for ($i = 0; $i < count($allData); $i++) {
                $data['book'][$i] = $this->bookTable->select()->where('id', $allData[$i]['id'])->find();

                $author = $this->bookAuthorTable->select('name')->join('author', 'book_author.author_id = author.id')->where('book_author.book_id = ' . $allData[$i]['id'])->find();

                $data['book'][$i][0]['author'] = $author;

                $publisher = $this->bookTable->select('publisher.name')->join('publisher', 'book.publisher_id = publisher.id')->where('book.id = ' . $allData[$i]['id'])->find();

                $data['book'][$i][0]['publisher'] = $publisher;
            }
            $data['token'] = csrf_hash();
            echo json_encode($data);
        }
    }

    public function searchauthor()
    {
        if ($this->request->getMethod() == 'get') {
            $searchItem = trim($this->request->getGet('searchItem'));
            $sort1 = trim($this->request->getGet('sort1'));

            if ($searchItem != '') {
                $allData = $this->authorTable->select('id, DATE_FORMAT(birthdate, "%d %M %Y") as birthdate, name, image')->where('name LIKE "%' . $searchItem . '%"')->orderBy('name', $sort1)->findAll();
            } else {
                $allData = $this->authorTable->select('id, DATE_FORMAT(birthdate, "%d %M %Y") as birthdate, name, image')->orderBy('name', $sort1)->findAll();
            }

            $data['author'] = $allData;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function searchpublisher()
    {
        if ($this->request->getMethod() == 'get') {
            $searchItem = trim($this->request->getGet('searchItem'));
            $sort1 = trim($this->request->getGet('sort1'));

            if ($searchItem != '') {
                $allData = $this->publisherTable->select('id, name, image')->where('name LIKE "%' . $searchItem . '%"')->orderBy('name', $sort1)->findAll();
            } else {
                $allData = $this->publisherTable->select('id, name, image')->orderBy('name', $sort1)->findAll();
            }

            $data['publisher'] = $allData;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }
}
