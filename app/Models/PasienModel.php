<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table            = 'pasien';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;

    public function search($keyword)
    {
        return $this->like('nama', $keyword)
            ->orLike('nik', $keyword)
            ->findAll();
    }
}
