<?php

namespace App\Controllers;

use App\Models\PasienModel;

class Pasien extends BaseController
{
    protected $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    public function index()
    {
        $data['pasien'] = $this->pasienModel->findAll();
        return view('pasien/index', $data);
    }

    public function create()
    {
        return view('pasien/form');
    }

    public function store()
    {
        $this->pasienModel->save([
            'nik'            => $this->request->getPost('nik'),
            'nama'           => $this->request->getPost('nama'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp')
        ]);

        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['pasien'] = $this->pasienModel->find($id);
        return view('pasien/form', $data);
    }

    public function update($id)
    {
        $this->pasienModel->update($id, [
            'nik'            => $this->request->getPost('nik'),
            'nama'           => $this->request->getPost('nama'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp')
        ]);

        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->pasienModel->delete($id);
        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil dihapus');
    }
}
