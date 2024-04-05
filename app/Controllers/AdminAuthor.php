<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Book_Author;

class AdminAuthor extends BaseController
{
    public function __construct()
    {
        $this->authorTable = new Author();
        $this->bookAuthorTable = new Book_Author();
        $this->session = session();
    }
    public function showpage()
    {
        $authorData = $this->authorTable->orderBy('name', 'ASC')->findAll();
        $data['authorData'] = $authorData;

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/authors', $data);
    }
    public function deleteauthor()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $prevImgName = $this->authorTable->select('image')->where('id', $id)->findAll();
            if ($prevImgName[0]['image'] != 'no-image.png') {
                unlink('./administrator/image_upload/penulis/' . $prevImgName[0]['image']);
            }
            $this->authorTable->where('id', $id)->delete();
            $this->bookAuthorTable->where('author_id', $id)->delete();
            return redirect()->to(base_url('admin/authors'));
        }
    }
}
