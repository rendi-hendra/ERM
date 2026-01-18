<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
    protected $table            = 'employee';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama',
        'sip',
        'jenis',
        'no_hp',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false;
}
