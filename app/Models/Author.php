<?php

namespace App\Models;

use CodeIgniter\Model;

class Author extends Model
{
    protected $table = 'author';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'birthdate', 'image'];
}
