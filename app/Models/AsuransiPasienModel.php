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
        'created_at'
    ];
    protected $useTimestamps    = true;

    public function getWithRelations()
    {
        return $this->select('asuransi_pasien.*, pasien.nama as nama_pasien, asuransi.nama_asuransi')
                    ->join('pasien', 'pasien.id = asuransi_pasien.pasien_id')
                    ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
                    ->findAll();
    }
}
