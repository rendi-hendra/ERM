<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Resep extends BaseController
{
    protected $resepModel;
    protected $resepDetailModel;

    public function __construct()
    {
        $this->resepModel = new \App\Models\ResepModel();
        $this->resepDetailModel = new \App\Models\ResepDetailModel();
    }

    public function index($kunjunganId)
    {
        // 1. Ambil header resep
        $resepHeaders = $this->resepModel
            ->getResepByKunjungan($kunjunganId)
            ->findAll();

        if (empty($resepHeaders)) {
            return view('kunjungan/resep/index', [
                'kunjunganId' => $kunjunganId,
                'resep' => []
            ]);
        }

        // 2. Ambil semua header ID
        $resepHeaderIds = array_column($resepHeaders, 'id');

        // 3. Ambil detail sekaligus
        $resepDetails = $this->resepDetailModel
            ->whereIn('resep_detail.resep_header_id', $resepHeaderIds)
            ->join('obat', 'obat.id = resep_detail.obat_id')
            ->findAll();

        // 4. Group detail per header
        $groupedDetail = [];
        foreach ($resepDetails as $detail) {
            $groupedDetail[$detail['resep_header_id']][] = $detail;
        }

        // dd($groupedDetail);

        return view('kunjungan/resep/index', [
            'kunjunganId' => $kunjunganId,
            'resep' => $resepHeaders,
            'resepDetail' => $groupedDetail
        ]);
    }
}
