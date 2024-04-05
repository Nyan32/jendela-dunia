<?php

namespace App\Models;

use CodeIgniter\Model;

class User_Detail extends Model
{
    protected $table = 'user_detail';
    protected $primaryKey = 'email';
    protected $allowedFields = ['name', 'phone', 'address', 'fine', 'gender', 'birthdate', 'email'];
}
