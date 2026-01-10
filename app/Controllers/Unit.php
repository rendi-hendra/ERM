<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Unit extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new \App\Models\UnitModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $unitModel = $this->unitModel;
        if ($keyword) {
            $unitModel = $unitModel
                ->like('nama', $keyword)
                ->orLike('kategori', $keyword);
        }

        $unit = $unitModel->paginate(10, 'unit');
        $pager = $unitModel->pager;

        return view('unit/index', [
            'unit' => $unit,
            'pager' => $pager,
            'keyword' => $keyword
        ]);
    }

    public function create()
    {

        return view('unit/form');
    }

    public function edit($id)
    {
        $unit = $this->unitModel->find($id);

        return view('unit/form', [
            'unit' => $unit
        ]);
    }
}
