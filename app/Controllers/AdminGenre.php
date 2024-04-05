<?php

namespace App\Controllers;

use App\Models\Book_Genre;
use App\Models\Genre;

class AdminGenre extends BaseController
{
    public function __construct()
    {
        $this->genreTable = new Genre();
        $this->bookGenreTable = new Book_Genre();
        $this->session = session();
    }
    public function showpage()
    {
        $genreData = $this->genreTable->orderBy('name', 'ASC')->findAll();
        $data['genreData'] = $genreData;

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/genres', $data);
    }
    public function deletegenre()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $this->genreTable->where('id', $id)->delete();
            $this->bookGenreTable->where('genre_id', $id)->delete();
            return redirect()->to(base_url('admin/genres'));
        }
    }
}
