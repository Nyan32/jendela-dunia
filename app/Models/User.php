<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    protected $allowedFields = ['email', 'password', 'status'];
}
