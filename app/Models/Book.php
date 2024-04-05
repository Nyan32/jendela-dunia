<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'title', 'category', 'year', 'amount', 'status', 'image', 'synopsis', 'publisher_id'];
}
