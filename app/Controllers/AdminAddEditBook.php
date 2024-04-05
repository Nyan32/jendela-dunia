<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Book_Author;
use App\Models\Book_Genre;

class AdminAddEditBook extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->bookTable = new Book();
        $this->bookAuthorTable = new Book_Author();
        $this->bookGenreTable = new Book_Genre();
        $this->session = session();
    }
    public function showpage($id = '')
    {
        if ($id != '') {
            $bookData = $this->bookTable->where('id', $id)->findAll();
            if ($bookData[0]['publisher_id'] == 0) {
                $bookData[0]['publisher_id'] = '';
            }
            $data['bookData'] = $bookData;

            $bookAuthorData = $this->bookAuthorTable->select('author_id')->where('book_id', $id)->findAll();
            $authorArr = [];
            foreach ($bookAuthorData as $author) {
                array_push($authorArr, $author['author_id']);
            }
            $authorArr = implode(':', $authorArr);

            if ($authorArr == '0') {
                $authorArr = '';
            }

            $data['bookData'][0]['author_id'] = $authorArr;

            $bookGenreData = $this->bookGenreTable->select('genre_id')->where('book_id', $id)->findAll();
            $genreArr = [];
            foreach ($bookGenreData as $genre) {
                array_push($genreArr, $genre['genre_id']);
            }
            $genreArr = implode(':', $genreArr);

            $data['bookData'][0]['genre_id'] = $genreArr;

            // print_r($data);
        } else {
            $data['bookData'] = null;
        }

        $data['errorRes'] = $this->session->getFlashdata('errorRes');
        $data['lastInputData'] = $this->session->getFlashdata('lastInputData');

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/addeditbook', $data);
    }

    public function addeditbook()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $verif_data = [
                'title' => trim(strip_tags($this->request->getPost('title'))),
                'category' => trim(strip_tags($this->request->getPost('category'))),
                'year' => trim(strip_tags($this->request->getPost('year'))),
                'amount' => trim(strip_tags($this->request->getPost('amount'))),
                'status' => trim(strip_tags($this->request->getPost('status'))),
                'synopsis' => trim(strip_tags($this->request->getPost('synopsis'))),
                'publisher_id' => trim(strip_tags($this->request->getPost('publisher_id'))),
                'genre_id' => trim(strip_tags($this->request->getPost('genre_id'))),
                'imageBook' => $this->request->getFile('imageBook')
            ];
            $verif_data['author_id'] = trim(strip_tags($this->request->getPost('author_id')));

            $this->session->setFlashdata('lastInputData', array(
                'title' => $this->request->getPost('title'),
                'category' => $this->request->getPost('category'),
                'year' => $this->request->getPost('year'),
                'amount' => $this->request->getPost('amount'),
                'status' => $this->request->getPost('status'),
                'synopsis' => $this->request->getPost('synopsis'),
                'publisher_id' => $this->request->getPost('publisher_id'),
                'author_id' => $this->request->getPost('author_id'),
                'genre_id' => $this->request->getPost('genre_id')
            ));

            if ($this->validation->run($verif_data, 'addbook') == FALSE) {
                $this->session->setFlashdata('errorRes', $this->validation->getErrors());
                if (isset($id)) {
                    return redirect()->to(base_url('admin/addeditbook/' . $id));
                } else {
                    return redirect()->to(base_url('admin/addeditbook'));
                }
            } else {
                $imageStatus = $this->request->getPost('imageStatus');
                if ($imageStatus != 'add' && $imageStatus != 'delete' && $imageStatus != 'keep') {
                    $this->session->setFlashdata('errorRes', array('image' => 'Image input is invalid.'));
                } else {
                    if (isset($id)) {
                        if ($imageStatus == 'keep') {
                            $this->bookTable->update($id, ['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id']]);

                            $this->bookAuthorTable->where('book_id', $id)->delete();
                            $authors = explode(':', $verif_data['author_id']);

                            foreach ($authors as $author) {
                                $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                            }

                            $this->bookGenreTable->where('book_id', $id)->delete();
                            $genres = explode(':', $verif_data['genre_id']);

                            foreach ($genres as $genre) {
                                $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                            }

                            return redirect()->to(base_url('admin/addeditbook/' . $id));
                        } else if ($imageStatus == 'add') {
                            $ext = $verif_data['imageBook']->getExtension();
                            $filename = $verif_data['imageBook']->getFilename();

                            if ($filename == '') {
                                $prevImgName = $this->bookTable->select('image')->where('id', $id)->findAll();
                                if ($prevImgName[0]['image'] != 'no-image.png') {
                                    unlink('./administrator/image_upload/buku/' . $prevImgName[0]['image']);
                                }

                                $this->bookTable->update($id, ['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id'], 'image' => 'no-image.png']);

                                $this->bookAuthorTable->where('book_id', $id)->delete();
                                $authors = explode(':', $verif_data['author_id']);

                                foreach ($authors as $author) {
                                    $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                                }

                                $this->bookGenreTable->where('book_id', $id)->delete();
                                $genres = explode(':', $verif_data['genre_id']);

                                foreach ($genres as $genre) {
                                    $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                                }

                                return redirect()->to(base_url('admin/addeditbook/' . $id));
                            } else {
                                $prevImgName = $this->bookTable->select('image')->where('id', $id)->findAll();
                                if ($prevImgName[0]['image'] != 'no-image.png') {
                                    unlink('./administrator/image_upload/buku/' . $prevImgName[0]['image']);
                                }

                                $this->bookTable->update($id, ['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id'], 'image' => 'tmp']);

                                $filename = 'buku-' . $id . '.' . $ext;
                                $this->bookTable->update($id, ['image' => $filename]);

                                $this->bookAuthorTable->where('book_id', $id)->delete();
                                $authors = explode(':', $verif_data['author_id']);

                                foreach ($authors as $author) {
                                    $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                                }

                                $this->bookGenreTable->where('book_id', $id)->delete();
                                $genres = explode(':', $verif_data['genre_id']);

                                foreach ($genres as $genre) {
                                    $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                                }

                                if ($verif_data['imageBook']->isValid() && !$verif_data['imageBook']->hasMoved()) {
                                    $verif_data['imageBook']->move('administrator/image_upload/buku', $filename);
                                }
                                return redirect()->to(base_url('admin/addeditbook/' . $id));
                            }
                        } else {
                            $prevImgName = $this->bookTable->select('image')->where('id', $id)->findAll();
                            if ($prevImgName[0]['image'] != 'no-image.png') {
                                unlink('./administrator/image_upload/buku/' . $prevImgName[0]['image']);
                            }

                            $this->bookTable->update($id, ['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id'], 'image' => 'no-image.png']);

                            $this->bookAuthorTable->where('book_id', $id)->delete();
                            $authors = explode(':', $verif_data['author_id']);

                            foreach ($authors as $author) {
                                $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                            }

                            $this->bookGenreTable->where('book_id', $id)->delete();
                            $genres = explode(':', $verif_data['genre_id']);

                            foreach ($genres as $genre) {
                                $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                            }

                            return redirect()->to(base_url('admin/addeditbook/' . $id));
                        }
                    } else {
                        if ($imageStatus == 'add' || $imageStatus == 'keep') {
                            $ext = $verif_data['imageBook']->getClientExtension();
                            $filename = $verif_data['imageBook']->getFilename();

                            if ($filename == '') {
                                $id = $this->bookTable->insert(['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id'], 'image' => 'no-image.png']);

                                $authors = explode(':', $verif_data['author_id']);

                                foreach ($authors as $author) {
                                    $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                                }

                                $genres = explode(':', $verif_data['genre_id']);

                                foreach ($genres as $genre) {
                                    $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                                }

                                return redirect()->to(base_url('admin/books'));
                            } else {
                                $id = $this->bookTable->insert(['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id'], 'image' => 'tmp']);

                                $authors = explode(':', $verif_data['author_id']);

                                foreach ($authors as $author) {
                                    $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                                }

                                $genres = explode(':', $verif_data['genre_id']);

                                foreach ($genres as $genre) {
                                    $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                                }

                                $filename = 'buku-' . $id . '.' . $ext;
                                $this->bookTable->update($id, ['image' => $filename]);

                                if ($verif_data['imageBook']->isValid() && !$verif_data['imageBook']->hasMoved()) {
                                    $verif_data['imageBook']->move('administrator/image_upload/buku', $filename);
                                }
                                return redirect()->to(base_url('admin/books'));
                            }
                        } else {
                            $id = $this->bookTable->insert(['title' => $verif_data['title'], 'category' => $verif_data['category'], 'year' => $verif_data['year'], 'amount' => $verif_data['amount'], 'status' => $verif_data['status'], 'synopsis' => $verif_data['synopsis'], 'publisher_id' => $verif_data['publisher_id'], 'image' => 'no-image.png']);

                            $authors = explode(':', $verif_data['author_id']);

                            foreach ($authors as $author) {
                                $this->bookAuthorTable->insert(['author_id' => $author, 'book_id' => $id]);
                            }

                            $genres = explode(':', $verif_data['genre_id']);

                            foreach ($genres as $genre) {
                                $this->bookGenreTable->insert(['genre_id' => $genre, 'book_id' => $id]);
                            }

                            return redirect()->to(base_url('admin/books'));
                        }
                    }
                }
            }
        }
    }
}
