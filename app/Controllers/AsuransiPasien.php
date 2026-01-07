<?php

namespace App\Controllers;

use App\Models\AsuransiPasienModel;
use App\Models\PasienModel;
use App\Models\AsuransiModel;

class AsuransiPasien extends BaseController
{
    protected $asuransiPasienModel;
    protected $pasienModel;
    protected $asuransiModel;
    protected $validation;

    public function __construct()
    {
        $this->asuransiPasienModel = new AsuransiPasienModel();
        $this->pasienModel = new PasienModel();
        $this->asuransiModel = new AsuransiModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $asuransiPasienModel = $this->asuransiPasienModel->getWithRelations();

        if ($keyword) {
            $asuransiPasienModel = $asuransiPasienModel->search($keyword);
        }

        $asuransiPasien = $asuransiPasienModel->paginate(10, 'asuransi_pasien');
        $pager = $this->asuransiPasienModel->pager;

        return view('asuransi_pasien/index', [
            'asuransiPasien' => $asuransiPasien,
            'pager' => $pager,
            'keyword' => $keyword
        ]);
    }

    public function getByPasien($pasien_id)
    {
        $asuransiPasienModel = $this->asuransiPasienModel;

        $data = $asuransiPasienModel
            ->select('asuransi_pasien.id, asuransi.nama_asuransi')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
            ->where('asuransi_pasien.pasien_id', $pasien_id)
            ->findAll();

        return $this->response->setJSON($data);
    }


    public function create()
    {

        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'pasien_id' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'Pasien wajib dipilih.',
                        'integer'  => 'ID pasien tidak valid.',
                    ]
                ],
                'asuransi_id' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'Asuransi wajib dipilih.',
                        'integer'  => 'ID asuransi tidak valid.',
                    ]
                ],
                'no_kartu' => [
                    'rules' => 'required|min_length[5]|max_length[20]|is_unique[asuransi_pasien.no_kartu]',
                    'errors' => [
                        'required'   => 'Nomor kartu asuransi wajib diisi.',
                        'min_length' => 'Nomor kartu minimal 5 karakter.',
                        'max_length' => 'Nomor kartu maksimal 20 karakter.',
                        'is_unique'  => 'Nomor kartu ini sudah terdaftar.',
                    ]
                ],
                'aktif' => [
                    'rules' => 'required|in_list[0,1]',
                    'errors' => [
                        'required' => 'Status aktif wajib diisi.',
                        'in_list' => 'Status aktif tidak valid.',
                    ]
                ],
            ];

            if (! $this->validate($rules)) {
                return view('asuransi_pasien/form', [
                    'asuransi' => $asuransi,
                    'pasien' => $pasien,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $this->asuransiPasienModel->save([
                'pasien_id'             => $this->request->getPost('pasien_id'),
                'asuransi_id'           => $this->request->getPost('asuransi_id'),
                'no_kartu'              => $this->request->getPost('no_kartu'),
                'aktif'                 => $this->request->getPost('aktif'),
            ]);

            return redirect()->to('/asuransi-pasien')->with('success', 'Data asuransi pasien berhasil ditambahkan.');
        }

        return view('asuransi_pasien/form', [
            'asuransi' => $asuransi,
            'pasien' => $pasien,
            'validation' => $this->validator,
        ]);
    }


    public function edit($id)
    {
        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();
        $asuransiPasien = $this->asuransiPasienModel->find($id);

        $data = [
            'asuransiPasien' => $asuransiPasien,
            'asuransi' => $asuransi,
            'pasien' => $pasien,
            'validation' => $this->validation
        ];

        return view('asuransi_pasien/form', $data);
    }

    public function update($id)
    {
        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();
        $asuransiPasien = $this->asuransiPasienModel->find($id);
        $pasienId = $asuransiPasien['pasien_id'];

        $rules = [
            'pasien_id' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Pasien wajib dipilih.',
                    'integer'  => 'ID pasien tidak valid.',
                ]
            ],
            'asuransi_id' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Asuransi wajib dipilih.',
                    'integer'  => 'ID asuransi tidak valid.',
                ]
            ],
            'no_kartu' => [
                'rules' => "required|min_length[5]|max_length[20]|is_unique[asuransi_pasien.no_kartu,id,{$id}]",
                'errors' => [
                    'required'   => 'Nomor kartu asuransi wajib diisi.',
                    'min_length' => 'Nomor kartu minimal 5 karakter.',
                    'max_length' => 'Nomor kartu maksimal 20 karakter.',
                    'is_unique'  => 'Nomor kartu ini sudah terdaftar.',
                ]
            ],
            'aktif' => [
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'Status aktif wajib diisi.',
                    'in_list' => 'Status aktif tidak valid.',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return view('asuransi_pasien/form', [
                'asuransiPasien' => $asuransiPasien,
                'asuransi' => $asuransi,
                'pasien' => $pasien,
                'validation' => $this->validator,
                'oldInput' => $this->request->getPost()
            ]);
        }

        $this->asuransiPasienModel->update($id, [
            'pasien_id'             => $this->request->getPost('pasien_id'),
            'asuransi_id'           => $this->request->getPost('asuransi_id'),
            'no_kartu'              => $this->request->getPost('no_kartu'),
            'aktif'                 => $this->request->getPost('aktif'),
        ]);

        return redirect()->to("/pasien/edit/$pasienId")->with('success', 'Data asuransi pasien berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->asuransiPasienModel->delete($id);
        return redirect()->to('/asuransi-pasien')->with('success', 'Data asuransi pasien berhasil dihapus.');
    }
}
