<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_employee', 'username', 'password', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;


    public function getByUsername($username)
    {
        return $this->select('employee.nama as employee_nama, employee.jenis as role, users.*')
            ->join('employee', 'employee.id = users.id_employee')
            ->where('users.username', $username)
            ->first();
        // return $this->where('username', $username)->first();
    }
}
