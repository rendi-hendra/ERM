<?php

namespace App\Models;

use CodeIgniter\Model;

class AsuransiModel extends Model
{
    protected $table            = 'asuransi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_asuransi',
        'no_kontak',
        'alamat',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;
}
