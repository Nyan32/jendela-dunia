<?php

namespace App\Models;

use CodeIgniter\Model;

class Book_Borrow extends Model
{
    protected $table = 'book_borrow';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'borrow_time', 'return_time', 'status', 'fine', 'book_id', 'user_email'];
}
