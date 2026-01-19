<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Soap extends BaseController
{
    protected $soapModel;

    public function __construct()
    {
        $this->soapModel = new \App\Models\SoapModel();
    }

    public function index($kunjunganId)
    {
        $soapModel = $this->soapModel->getSoapByEmployee($kunjunganId);
        $keyword = $this->request->getGet('keyword');
        $soapModel = $this->soapModel;
        if ($keyword) {
            $soapModel = $soapModel
                ->like('subjective', $keyword)
                ->orLike('objective', $keyword)
                ->orLike('assessment', $keyword)
                ->orLike('plan', $keyword);
        }

        $soap = $soapModel->paginate(10, 'soap');
        $pager = $soapModel->pager;

        return view('kunjungan/soap/index', [
            'kunjunganId' => $kunjunganId,
            'soap' => $soap,
            'pager' => $pager,
            'keyword' => $keyword,
        ]);
    }
}
