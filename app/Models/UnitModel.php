<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'unit';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama',
        'kategori',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;
}
