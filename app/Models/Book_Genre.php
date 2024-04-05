<?php

namespace App\Models;

use CodeIgniter\Model;

class Book_Genre extends Model
{
    protected $table = 'book_genre';
    protected $primaryKey = 'id';
    protected $allowedFields = ['book_id', 'genre_id'];
}
