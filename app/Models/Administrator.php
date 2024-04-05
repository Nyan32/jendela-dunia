<?php

namespace App\Models;

use CodeIgniter\Model;

class Administrator extends Model
{
    protected $table = 'administrator';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'email', 'password'];
}
