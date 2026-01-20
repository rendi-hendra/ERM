<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepDetailModel extends Model
{
    protected $table            = 'resep_detail';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'resep_header_id',
        'obat_id',
        'aturan_pakai',
        'qty',
    ];
    protected $useTimestamps    = true;

    public function getResepByResepHeader($resepId)
    {
        return $this->select('resep_detail.*, obat.*, resep_header.*')
            ->where('resep_detail.resep_header_id', $resepId)
            ->join('resep_header', 'resep_header.id = resep_detail.resep_header_id')
            ->join('obat', 'obat.id = resep_detail.obat_id')
            ->orderBy('resep_detail.created_at', 'DESC');
    }
}
