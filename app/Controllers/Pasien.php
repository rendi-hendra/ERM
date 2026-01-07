<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\AsuransiPasienModel;

class Pasien extends BaseController
{
    protected $pasienModel;
    protected $asuransiPasienModel;
    protected $validation;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
        $this->asuransiPasienModel = new AsuransiPasienModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $pasienModel = $this->pasienModel;

        if ($keyword) {
            $pasienModel = $pasienModel
                ->like('nama', $keyword)
                ->orLike('nik', $keyword);
        }

        $pasien = $pasienModel->paginate(10, 'pasien');
        $pager = $pasienModel->pager;

        return view('pasien/index', [
            'pasien' => $pasien,
            'pager' => $pager,
            'keyword' => $keyword,
        ]);
    }

    public function create()
    {

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'nik' => [
                    'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[pasien.nik]',
                    'errors' => [
                        'required'   => 'NIK wajib diisi.',
                        'numeric'    => 'NIK harus berupa angka.',
                        'min_length' => 'NIK harus 16 digit.',
                        'max_length' => 'NIK harus 16 digit.',
                        'is_unique'  => 'NIK sudah terdaftar.'
                    ]
                ],
                'nama' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required'   => 'Nama wajib diisi.',
                        'min_length' => 'Nama minimal 3 huruf.'
                    ]
                ],
                'tanggal_lahir' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required'   => 'Tanggal lahir wajib diisi.',
                        'valid_date' => 'Format tanggal tidak valid.'
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'required|in_list[L,P]',
                    'errors' => [
                        'required' => 'Jenis kelamin wajib dipilih.',
                        'in_list'  => 'Jenis kelamin tidak valid.'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'Alamat wajib diisi.',
                        'min_length' => 'Alamat minimal 3 huruf.'
                    ]
                ],
                'no_hp' => [
                    'rules' => 'required|numeric|min_length[10]|max_length[15]',
                    'errors' => [
                        'required'   => 'Nomor HP wajib diisi.',
                        'numeric'    => 'Nomor HP hanya boleh angka.',
                        'min_length' => 'Nomor HP minimal 10 digit.',
                        'max_length' => 'Nomor HP maksimal 15 digit.'
                    ]
                ],
            ];

            if (! $this->validate($rules)) {
                return view('pasien/form', [
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $this->pasienModel->save([
                'nik'            => $this->request->getPost('nik'),
                'nama'           => $this->request->getPost('nama'),
                'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
                'alamat'         => $this->request->getPost('alamat'),
                'no_hp'          => $this->request->getPost('no_hp')
            ]);

            return redirect()->to('/pasien')->with('success', 'Data pasien berhasil ditambahkan.');
        }

        return view('pasien/form', [
            'validation' => $this->validator,
        ]);
    }


    public function edit($id)
    {
        // Asurnsi pasien
        $keyword = $this->request->getGet('keyword');
        $asuransiPasienModel = $this->asuransiPasienModel->getWithRelations($id);

        if ($keyword) {
            $asuransiPasienModel = $asuransiPasienModel->search($keyword);
        }

        $asuransiPasien = $asuransiPasienModel->paginate(10, 'asuransi_pasien');
        $pager = $this->asuransiPasienModel->pager;

        $data = [
            'pasien'     => $this->pasienModel->find($id),
            'asuransiPasien' => $asuransiPasien,
            'pager' => $pager,
            'validation' => $this->validation
        ];

        return view('pasien/form', $data);
    }

    public function update($id)
    {
        $rules = [
            'nik' => [
                'rules' => "required|numeric|min_length[16]|max_length[16]|is_unique[pasien.nik,id,{$id}]",
                'errors' => [
                    'required'   => 'NIK wajib diisi.',
                    'numeric'    => 'NIK harus berupa angka.',
                    'min_length' => 'NIK harus 16 digit.',
                    'max_length' => 'NIK harus 16 digit.',
                    'is_unique'  => 'NIK sudah terdaftar untuk pasien lain.'
                ]
            ],
            'nama' => 'required|min_length[3]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'alamat' => 'required',
            'no_hp' => 'required|numeric|min_length[10]|max_length[15]'
        ];

        if (!$this->validate($rules)) {
            return view('pasien/form', [
                'validation' => $this->validator,
                'pasien' => $this->pasienModel->find($id)
            ]);
        }

        $this->pasienModel->update($id, [
            'nik'            => $this->request->getPost('nik'),
            'nama'           => $this->request->getPost('nama'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp')
        ]);

        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->pasienModel->delete($id);
        return redirect()->to('/pasien')->with('success', 'Data pasien berhasil dihapus.');
    }
}
