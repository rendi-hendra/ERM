<?php

namespace App\Models;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
    protected $table            = 'kunjungan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'pasien_id',
        'tanggal_kunjungan',
        'keluhan',
        'dokter',
        'metode_pembayaran',
        'asuransi_pasien_id',
        'created_at'
    ];
    protected $useTimestamps    = true;

    public function getWithRelations()
    {
        return $this->select('kunjungan.*, pasien.nama as nama_pasien, asuransi.nama_asuransi')
                    ->join('pasien', 'pasien.id = kunjungan.pasien_id')
                    ->join('asuransi_pasien', 'asuransi_pasien.id = kunjungan.asuransi_pasien_id', 'left')
                    ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id', 'left')
                    ->orderBy('kunjungan.tanggal_kunjungan', 'DESC')
                    ->findAll();
    }
}
