<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanModel extends Model
{
    protected $table            = 'pemeriksaan_kunjungan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kunjungan_id',
        'employee_id',
        'suhu',
        'td_sistolik',
        'td_diastolik',
        'nadi',
        'rr',
        'berat_badan',
        'tinggi_badan',
        'catatan'
    ];
    protected $useTimestamps    = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPemeriksaanByKunjungan($kunjunganId)
    {
        return $this->select('pemeriksaan_kunjungan.*, employee.nama as employee_name')
            ->where('pemeriksaan_kunjungan.kunjungan_id', $kunjunganId)
            ->join('employee', 'employee.id = pemeriksaan_kunjungan.employee_id')
            ->orderBy('pemeriksaan_kunjungan.created_at', 'DESC');
    }
}
