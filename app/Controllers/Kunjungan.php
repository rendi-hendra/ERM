<?php

namespace App\Controllers;

use App\Models\KunjunganModel;
use App\Models\PasienModel;
use App\Models\AsuransiModel;
use App\Models\AsuransiPasienModel;

class Kunjungan extends BaseController
{
    protected $kunjunganModel;
    protected $pasienModel;
    protected $asuransiModel;
    protected $asuransiPasienModel;
    protected $validation;

    public function __construct()
    {
        $this->kunjunganModel = new KunjunganModel();
        $this->pasienModel = new PasienModel();
        $this->asuransiModel = new AsuransiModel();
        $this->asuransiPasienModel = new AsuransiPasienModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $kunjunganModel = $this->kunjunganModel->getWithRelations();

        if ($keyword) {
            $kunjunganModel = $kunjunganModel->search($keyword);
        }

        $kunjungan = $kunjunganModel->paginate(10, 'kunjungan');
        $pager = $this->kunjunganModel->pager;

        // $kunjungans = $this->kunjunganModel->getWithRelations()->findAll();

        // dd($kunjungan[0]['id']);

        return view('kunjungan/index', [
            'kunjungan' => $kunjungan,
            'pager' => $pager,
            'keyword' => $keyword,
            'validator' => $this->validation
        ]);
    }


    public function create()
    {

        $pasien = $this->pasienModel->select()->findAll();
        $asuransi = $this->asuransiModel->select()->findAll();
        $kunjungan = $this->kunjunganModel->getWithRelations()->findAll();


        $asuransiPasien = $this->asuransiPasienModel->select('asuransi_pasien.*, pasien.nik as nik, pasien.nama as nama_pasien, asuransi.nama_asuransi')
            ->join('pasien', 'pasien.id = asuransi_pasien.pasien_id')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
            ->findAll();

        // $kunjunganPasien = $this->kunjunganModel->select('kunjungan.*, pasien.nama as nama_pasien, asuransi.nama_asuransi')
        //     ->join('pasien', 'pasien.id = asuransi_pasien.pasien_id')
        //     ->join('asuransi', 'asuransi.id = kunjungan.asuransi_pasien_id')
        //     ->findAll();


        // dd($asuransiPasien);
        // dd($kunjunganPasien);

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'pasien_id' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'Pasien wajib dipilih.',
                        'integer'  => 'ID pasien tidak valid.',
                    ]
                ],
                'asuransi_pasien_id' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'Asuransi wajib dipilih.',
                        'integer'  => 'ID asuransi tidak valid.',
                    ]
                ],

                'tanggal_kunjungan' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'Tanggal kunjungan wajib diisi.',
                        'valid_date'  => 'Tanggal kunjungan tidak valid.',
                    ]
                ],
                'metode_pembayaran' => [
                    'rules' => 'required|string',
                    'errors' => [
                        'required' => 'Metode pembayaran wajib diisi.',
                        'string'  => 'Metode pembayaran tidak valid.',
                    ]
                ],
                'keluhan' => [
                    'rules' => 'required|string|max_length[255]',
                    'errors' => [
                        'required' => 'Keluhan wajib diisi.',
                        'string'  => 'Keluhan tidak valid.',
                    ]
                ],
                'dokter' => [
                    'rules' => 'required|string|max_length[100]',
                    'errors' => [
                        'required' => 'Nama dokter wajib diisi.',
                        'string'  => 'Nama dokter tidak valid.',
                    ]
                ],
            ];

            if (! $this->validate($rules)) {
                return view('kunjungan/form', [
                    // 'kunjungan' => $kunjungan,
                    'asuransi_pasien' => $asuransiPasien,
                    'asuransi' => $asuransi,
                    'pasien' => $pasien,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $this->kunjunganModel->save([
                'pasien_id'             => $this->request->getPost('pasien_id'),
                'asuransi_pasien_id'    => $this->request->getPost('asuransi_pasien_id'),
                'tanggal_kunjungan'       => $this->request->getPost('tanggal_kunjungan'),
                'metode_pembayaran'       => $this->request->getPost('metode_pembayaran'),
                'keluhan'               => $this->request->getPost('keluhan'),
                'dokter'                => $this->request->getPost('dokter'),
            ]);

            return redirect()->to('/kunjungan')->with('success', 'Data asuransi pasien berhasil ditambahkan.');
        }

        // dd($asuransiPasien);

        return view('kunjungan/form', [
            // 'kunjungan' => $kunjungan,
            'asuransi_pasien' => $asuransiPasien,
            'asuransi' => $asuransi,
            'pasien' => $pasien,
            'validation' => $this->validator,
        ]);
    }


    public function edit($id)
    {
        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();
        $kunjungan = $this->kunjunganModel->getWithRelations()->find($id);
        $asuransiPasien = $this->asuransiPasienModel
            ->select('asuransi_pasien.id, asuransi.nama_asuransi')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
            ->where('asuransi_pasien.pasien_id', $id)
            ->findAll();

        $data = [
            'asuransi_pasien' => $asuransiPasien,
            'kunjungan' => $kunjungan,
            'asuransi' => $asuransi,
            'pasien' => $pasien,
            'validation' => $this->validation
        ];

        return view('kunjungan/form', $data);
    }

    public function update($id)
    {
        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();
        $kunjungan = $this->kunjunganModel->find($id);

        $rules = [
            'pasien_id' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Pasien wajib dipilih.',
                    'integer'  => 'ID pasien tidak valid.',
                ]
            ],
            'asuransi_pasien_id' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Asuransi wajib dipilih.',
                    'integer'  => 'ID asuransi tidak valid.',
                ]
            ],

            'tanggal_kunjungan' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal kunjungan wajib diisi.',
                    'valid_date'  => 'Tanggal kunjungan tidak valid.',
                ]
            ],
            'metode_pembayaran' => [
                'rules' => 'required|string',
                'errors' => [
                    'required' => 'Metode pembayaran wajib diisi.',
                    'string'  => 'Metode pembayaran tidak valid.',
                ]
            ],
            'keluhan' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => 'Keluhan wajib diisi.',
                    'string'  => 'Keluhan tidak valid.',
                ]
            ],
            'dokter' => [
                'rules' => 'required|string|max_length[100]',
                'errors' => [
                    'required' => 'Nama dokter wajib diisi.',
                    'string'  => 'Nama dokter tidak valid.',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return view('kunjungan/form', [
                'kunjungan' => $kunjungan,
                'asuransi' => $asuransi,
                'pasien' => $pasien,
                'validation' => $this->validator,
                'oldInput' => $this->request->getPost()
            ]);
        }

        $this->kunjunganModel->update($id, [
            'pasien_id'             => $this->request->getPost('pasien_id'),
            'asuransi_pasien_id'    => $this->request->getPost('asuransi_pasien_id'),
            'tanggal_kunjungan'       => $this->request->getPost('tanggal_kunjungan'),
            'metode_pembayaran'       => $this->request->getPost('metode_pembayaran'),
            'keluhan'               => $this->request->getPost('keluhan'),
            'dokter'                => $this->request->getPost('dokter'),
        ]);

        return redirect()->to('/kunjungan')->with('success', 'Data asuransi pasien berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->kunjunganModel->delete($id);
        return redirect()->to('/kunjungan')->with('success', 'Data asuransi pasien berhasil dihapus.');
    }
}
