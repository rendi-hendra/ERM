<?php

namespace App\Models;

use CodeIgniter\Model;

class AsuransiPasienModel extends Model
{
    protected $table            = 'asuransi_pasien';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'pasien_id',
        'asuransi_id',
        'no_kartu',
        'aktif',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;

    public function getWithRelations()
    {
        return $this->select('asuransi_pasien.*, pasien.nama as nama_pasien, pasien.nik as nik, asuransi.nama_asuransi')
            ->join('pasien', 'pasien.id = asuransi_pasien.pasien_id')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id');
    }

    public function search($keyword)
    {
        return $this->groupStart()
            ->like('pasien.nama', $keyword)
            ->orLike('asuransi.nama_asuransi', $keyword)
            ->orLike('asuransi_pasien.no_kartu', $keyword)
            ->groupEnd();
    }
}
