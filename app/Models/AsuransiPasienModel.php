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
        'hak_kelas',
        'aktif',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;



    public function getWithRelations($pasienId)
    {
        return $this->select('asuransi_pasien.*, asuransi.nama_asuransi, asuransi.no_kontak')
            ->join('pasien', 'pasien.id = asuransi_pasien.pasien_id')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
            ->where('pasien.id', $pasienId);
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
