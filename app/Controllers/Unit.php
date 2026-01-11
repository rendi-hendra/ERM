<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Unit extends BaseController
{
    protected $unitModel;
    protected $validation;
    protected $rules = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required'   => 'Nama unit wajib diisi.',
                'min_length' => 'Nama unit minimal 3 karakter.'
            ]
        ],
        'kategori' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required'   => 'Kategori unit wajib diisi.',
                'min_length' => 'Kategori unit minimal 3 karakter.'
            ]
        ]
    ];

    public function __construct()
    {
        $this->unitModel = new \App\Models\UnitModel();
        $this->validation = \Config\Services::validation();
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
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            if (! $this->validate($this->rules)) {
                return view('unit/form', [
                    'validation' => $this->validation,
                    'oldInput' => $data
                ]);
            }
            $this->unitModel->insert([
                'nama' => $data['nama'],
                'kategori' => $data['kategori']
            ]);
            return redirect()->to(base_url('unit'))->with('success', 'Unit berhasil ditambahkan.');
        }

        return view('unit/form');
    }

    public function edit($id)
    {
        $unit = $this->unitModel->find($id);

        if (!$unit) {
            throw new PageNotFoundException('Unit tidak ditemukan.');
        }

        return view('unit/form', [
            'unit' => $unit
        ]);
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            if (! $this->validate($this->rules)) {
                return view('unit/form', [
                    'validation' => $this->validation,
                    'oldInput' => $data,
                    'unit' => $this->unitModel->find($id)
                ]);
            }
            $this->unitModel->update($id, [
                'nama' => $data['nama'],
                'kategori' => $data['kategori']
            ]);
            return redirect()->to(base_url('unit'))->with('success', 'Unit berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        $unit = $this->unitModel->find($id);
        if (!$unit) {
            throw new PageNotFoundException('Unit tidak ditemukan.');
        }

        $this->unitModel->delete($id);
        return redirect()->to(base_url('unit'))->with('success', 'Unit berhasil dihapus.');
    }
}
