<?php

namespace App\Models;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
    protected $table            = 'kunjungan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'pasien_id',
        'asuransi_pasien_id',
        'unit_id',
        'tanggal_kunjungan',
        'keluhan',
        'dpjp',
        'metode_pembayaran',
        'created_at'
    ];
    protected $useTimestamps    = true;

    public function getWithRelations()
    {
        return $this->select('kunjungan.*, pasien.nama as nama_pasien, asuransi.nama_asuransi, unit.nama as nama_unit, employee.nama as nama_dpjp')
            ->join('pasien', 'pasien.id = kunjungan.pasien_id')
            ->join('asuransi_pasien', 'asuransi_pasien.id = kunjungan.asuransi_pasien_id', 'left')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id', 'left')
            ->join('unit', 'unit.id = kunjungan.unit_id', 'left')
            ->join('employee', 'employee.id = kunjungan.dpjp', 'left')
            ->orderBy('kunjungan.created_at', 'DESC')
            ->orderBy('kunjungan.tanggal_kunjungan', 'DESC');
    }

    public function search($keyword)
    {
        return $this->groupStart()
            ->like('pasien.nama', $keyword)
            ->orLike('pasien.nik', $keyword)
            ->orLike('asuransi.nama_asuransi', $keyword)
            ->orLike('asuransi_pasien.no_kartu', $keyword)
            ->groupEnd();
    }
}
