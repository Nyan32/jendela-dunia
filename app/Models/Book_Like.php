<?php

namespace App\Models;

use CodeIgniter\Model;

class Book_Like extends Model
{
    protected $table = 'book_like';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user_email', 'book_id'];
}
