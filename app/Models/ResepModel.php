<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table            = 'resep_header';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kunjungan_id',
        'employee_id',
        'catatan',
    ];
    protected $useTimestamps    = true;

    public function getResepByKunjungan($kunjunganId)
    {
        return $this->select('resep_header.*, employee.nama as employee_name')
            ->where('resep_header.kunjungan_id', $kunjunganId)
            ->join('employee', 'employee.id = resep_header.employee_id')
            ->orderBy('resep_header.created_at', 'DESC');
    }
}
