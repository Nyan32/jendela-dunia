<?php

namespace App\Controllers;

use App\Models\Publisher;
use App\Models\Book;

class AdminPublisher extends BaseController
{
    public function __construct()
    {
        $this->publisherTable = new Publisher();
        $this->bookTable = new Book();
        $this->session = session();
    }
    public function showpage()
    {
        $publisherData = $this->publisherTable->orderBy('name', 'ASC')->findAll();
        $data['publisherData'] = $publisherData;

        $account = $this->session->get('AdminLogin');
        if ($account != null && $account != '') {
            $data['AdminLogin'] = $account;
        } else {
            $data['AdminLogin'] = null;
        }

        return view('adminpage/publishers', $data);
    }
    public function deletepublisher()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $prevImgName = $this->publisherTable->select('image')->where('id', $id)->findAll();
            if ($prevImgName[0]['image'] != 'no-image.png') {
                unlink('./administrator/image_upload/penerbit/' . $prevImgName[0]['image']);
            }
            $this->bookTable->where('publisher_id', $id)->set('publisher_id', null)->update();
            $this->publisherTable->where('id', $id)->delete();
            return redirect()->to(base_url('admin/publishers'));
        }
    }
}
