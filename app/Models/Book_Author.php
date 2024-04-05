<?php

namespace App\Models;

use CodeIgniter\Model;

class Book_Author extends Model
{
    protected $table = 'book_author';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'book_id', 'author_id'];
}
