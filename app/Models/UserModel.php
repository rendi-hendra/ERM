<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password', 'nama', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;


    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
