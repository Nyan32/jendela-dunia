<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;
use App\Models\Book_Genre;
use App\Models\Book_Like;
use App\Models\Book_Borrow;
use App\Models\User_Detail;

class DetailBook extends BaseController
{
    public function __construct()
    {
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->bookGenreTable = new Book_Genre();
        $this->bookLikeTable = new Book_Like();
        $this->bookBorrowTable = new Book_Borrow();
        $this->userDetailTable = new User_Detail();
        $this->session = session();
    }

    public function showpage($id = '0')
    {
        $data['bookData'] = null;
        if (is_numeric($id)) {
            $books = $this->bookTable->select('id, title, category, year, amount, status, image, synopsis')->where('id', $id)->findAll();

            if (count($books) > 0) {
                $data['bookData'] = $books;

                $author = $this->bookAuthorTable->select('author.name, author.birthdate, author.image')->join('author', 'book_author.author_id = author.id')->orderBy('author.name', 'ASC')->where('book_author.book_id', $data['bookData'][0]['id'])->find();

                $data['bookData'][0]['author'] = $author;

                $publisher = $this->bookTable->select('publisher.name, publisher.address, publisher.image')->join('publisher', 'book.publisher_id = publisher.id')->where('book.id', $data['bookData'][0]['id'])->find();

                $data['bookData'][0]['publisher'] = $publisher;

                $genre = $this->bookGenreTable->select('genre.name')->join('genre', 'book_genre.genre_id = genre.id')->where('book_genre.book_id', $data['bookData'][0]['id'])->find();

                $data['bookData'][0]['genre'] = $genre;

                $email = $this->session->get('LoggedIn');
                if ($email != null && $email != '') {
                    $liked = $this->bookTable->join('book_like', 'book_like.book_id = book.id')->join('user', 'book_like.user_email = user.email')->where('book_like.user_email', $email)->where('book_like.book_id', $id)->findAll();

                    if (count($liked) > 0) {
                        $data['alreadyLiked'] = true;
                    } else {
                        $data['alreadyLiked'] = false;
                    }
                } else {
                    $data['alreadyLiked'] = false;
                }

                if ($email != null && $email != '') {
                    $borrow = $this->bookTable->join('book_borrow', 'book_borrow.book_id = book.id')->join('user', 'book_borrow.user_email = user.email')->where('book_borrow.user_email', $email)->where('book_borrow.book_id', $id)->where('book_borrow.status', 'NOT RETURNED')->findAll();

                    if (count($borrow) > 0) {
                        $data['alreadyBorrowed'] = true;
                    } else {
                        $data['alreadyBorrowed'] = false;
                    }
                } else {
                    $data['alreadyBorrowed'] = false;
                }
            }
        }

        $account = $this->session->get('LoggedIn');
        if ($account != null && $account != '') {
            $data['LoggedIn'] = $account;
        } else {
            $data['LoggedIn'] = null;
        }

        $error = $this->session->getFlashdata('error');
        if ($error != null && $error != '') {
            $data['error'] = $error;
        } else {
            $data['error'] = null;
        }

        return view('page/detailbook', $data);
    }

    public function likebook()
    {
        if ($this->request->getMethod() == 'post') {
            $likeID = $this->request->getPost('like');
            $bookAvail = $this->bookLikeTable->select()->where('book_id', $likeID)->where('user_email', $this->session->get('LoggedIn'))->findAll();

            if (count($bookAvail) == 0) {
                $this->bookLikeTable->insert(['book_id' => $likeID, 'user_email' => $this->session->get('LoggedIn')]);
            } else {
                $this->session->setFlashdata('error', 'Failed to like book');
            }
        }

        return redirect()->to(base_url('detailbook') . '/' . $likeID);
    }

    public function unlikebook()
    {
        if ($this->request->getMethod() == 'post') {
            $unlikeID = $this->request->getPost('unlike');
            $bookAvail = $this->bookLikeTable->select()->where('book_id', $unlikeID)->where('user_email', $this->session->get('LoggedIn'))->findAll();

            if (count($bookAvail) > 0) {
                $this->bookLikeTable->where('book_id', $unlikeID)->where('user_email', $this->session->get('LoggedIn'))->delete();
            } else {
                $this->session->setFlashdata('error', 'Failed to unlike book');
            }
        }

        return redirect()->to(base_url('detailbook') . '/' . $unlikeID);
    }

    public function borrowbook()
    {
        if ($this->request->getMethod() == 'post') {
            $borrowID = $this->request->getPost('borrow');
            $bookAvail = $this->bookBorrowTable->select()->where('book_id', $borrowID)->where('user_email', $this->session->get('LoggedIn'))->where('book_borrow.status', 'NOT RETURNED')->findAll();

            if (count($bookAvail) == 0) {
                $fine = $this->bookBorrowTable->select('SUM(user_detail.fine) AS fine')->join('user', 'user.email = book_borrow.user_email')->join('user_detail', 'user_detail.email = user.email')->where('user_email', $this->session->get('LoggedIn'))->where('book_borrow.status', 'RETURNED')->findAll();

                if ($fine[0]['fine'] <= 5000) {
                    $numBorBooks = $this->bookBorrowTable->select()->where('user_email', $this->session->get('LoggedIn'))->where('book_borrow.status', 'NOT RETURNED')->findAll();

                    if (count($numBorBooks) <= 3) {
                        $isAvailable = $this->bookTable->select('status')->where('id', $borrowID)->findAll();

                        if ($isAvailable[0]['status'] == 'available') {
                            $numBooks = $this->bookBorrowTable->select('book.amount AS amount')->join('book', 'book_borrow.book_id = book.id')->where('book.id', $borrowID)->where('book_borrow.status', 'NOT RETURNED')->findAll();

                            if (count($numBooks) == 0) {
                                $this->bookBorrowTable->insert([
                                    'book_id' => $borrowID,
                                    'user_email' => $this->session->get('LoggedIn'),
                                    'borrow_time' => date('Y-m-d')
                                ]);
                            } else if (count($numBooks) < $numBooks[0]['amount']) {
                                $this->bookBorrowTable->insert([
                                    'book_id' => $borrowID,
                                    'user_email' => $this->session->get('LoggedIn'),
                                    'borrow_time' => date('Y-m-d')
                                ]);
                            } else {
                                $this->session->setFlashdata('error', 'Book is not available.');
                            }
                        } else {
                            $this->session->setFlashdata('error', 'Book is not available.');
                        }
                    } else {
                        $this->session->setFlashdata('error', 'The number of books that can be borrowed has reached the limit.');
                    }
                } else {
                    $this->session->setFlashdata('error', 'The fine is already at its limit.');
                }
            } else {
                $this->session->setFlashdata('error', 'Book is already borrowed.');
            }
        }

        return redirect()->to(base_url('detailbook') . '/' . $borrowID);
    }

    public function returnbook()
    {
        if ($this->request->getMethod() == 'post') {
            $returnID = $this->request->getPost('return');
            $bookAvail = $this->bookBorrowTable->select()->where('book_id', $returnID)->where('user_email', $this->session->get('LoggedIn'))->where('status', 'NOT RETURNED')->findAll();

            if (count($bookAvail) > 0) {
                $this->bookBorrowTable->update($bookAvail[0]['id'], [
                    'return_time' => date('Y-m-d'),
                    'status' => 'RETURNED'
                ]);

                $passedDay = $this->bookBorrowTable->select('DATEDIFF(return_time, borrow_time) AS passedday')->where('id', $bookAvail[0]['id'])->findAll();

                if ($passedDay[0]['passedday'] < 7) {
                    $passedDay = 0;
                } else {
                    $passedDay = $passedDay[0]['passedday'] - 7;
                }

                $fine = 1000 * $passedDay;

                $this->bookBorrowTable->update($bookAvail[0]['id'], [
                    'fine' => $fine
                ]);

                $userFine = $this->userDetailTable->select('fine')->where('email', $this->session->get('LoggedIn'))->findAll();
                $userFine = $userFine[0]['fine'] + $fine;
                $this->userDetailTable->update(['email' => $this->session->get('LoggedIn')], ['fine' => $userFine]);
            } else {
                $this->session->setFlashdata('error', 'Book is not borrowed.');
            }
        }

        return redirect()->to(base_url('detailbook') . '/' . $returnID);
    }
}
