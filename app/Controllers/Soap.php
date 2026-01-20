<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Soap extends BaseController
{
    protected $soapModel;
    protected $pemeriksaanModel;
    protected $resepModel;
    protected $resepDetailModel;

    public function __construct()
    {
        $this->soapModel = new \App\Models\SoapModel();
        $this->pemeriksaanModel = new \App\Models\PemeriksaanModel();
        $this->resepModel = new \App\Models\ResepModel();
        $this->resepDetailModel = new \App\Models\ResepDetailModel();
    }

    public function index($kunjunganId)
    {
        $soap = $this->soapModel->getSoapByEmployee($kunjunganId)->findAll();

        return view('kunjungan/soap/index', [
            'kunjunganId' => $kunjunganId,
            'soap' => $soap,
        ]);
    }

    public function create($kunjunganId)
    {
        $existingSoap = $this->soapModel->countAllResults();
        if (!$existingSoap) {
            return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/soap'));
        };

        if ($this->request->getMethod() === 'POST') {
            $rules = [];
            $soap = $this->request->getPost();
            if ($soap['status'] == 0) {
                $rules['subjective'] = [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Subjective wajib diisi saat menyimpan draf.'
                    ]
                ];
            } else {
                $rules = [
                    'subjective' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Subjective wajib diisi.'
                        ]
                    ],
                    'objective' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Objective wajib diisi.'
                        ]
                    ],
                    'assessment' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Assessment wajib diisi.'
                        ]
                    ],
                    'plan' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Plan wajib diisi.'
                        ]
                    ],
                ];
            }

            if (!$this->validate($rules)) {
                return view('kunjungan/soap/form', [
                    'kunjunganId' => $kunjunganId,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost(),
                ]);
            }

            $soapData = [
                'kunjungan_id' => $kunjunganId,
                'employee_id' => session()->get('employee_id'),
                'subjective' => $soap['subjective'],
                'assesment' => $soap['assessment'] == '' ? null : $soap['assessment'],
                'status' => $soap['status'],
            ];

            $this->soapModel->insert($soapData);
            session()->setFlashdata('success', 'Data SOAP berhasil ditambahkan.');
            return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/soap'));
        }

        return view('kunjungan/soap/form', [
            'kunjunganId' => $kunjunganId,
        ]);
    }

    public function edit($kunjunganId, $id)
    {
        $soap = $this->soapModel->find($id);
        $pemeriksaan = $this->pemeriksaanModel->getPemeriksaanByKunjungan($kunjunganId)->first();
        $objective = $pemeriksaan
            ? generateObjective($pemeriksaan)
            : null;


        $resep = $this->resepModel
            ->where('kunjungan_id', $kunjunganId)
            ->first();

        $plan = null;

        if ($resep) {
            $details = $this->resepDetailModel
                ->select('
            resep_detail.*,
            obat.nama,
            obat.sediaan,
            obat.kekuatan
        ')
                ->join('obat', 'obat.id = resep_detail.obat_id')
                ->where('resep_header_id', $resep['id'])
                ->findAll();

            $plan = generatePlan($details);
        }

        return view('kunjungan/soap/form', [
            'kunjunganId' => $kunjunganId,
            'soap' => $soap,
            'objective' => $objective,
            'plan' => $plan
        ]);
    }

    public function update($kunjunganId, $id)
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [];
            $soap = $this->request->getPost();
            $getSoap = $this->soapModel->find($id);

            if ($soap['status'] == 0) {
                $rules['subjective'] = [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Subjective wajib diisi saat menyimpan draf.'
                    ]
                ];
            } else {
                $rules = [
                    'subjective' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Subjective wajib diisi.'
                        ]
                    ],
                    'objective' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Objective wajib diisi.'
                        ]
                    ],
                    'assessment' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Assessment wajib diisi.'
                        ]
                    ],
                    'plan' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Plan wajib diisi.'
                        ]
                    ],
                ];
            }

            if (!$this->validate($rules)) {
                return view('kunjungan/soap/form', [
                    'kunjunganId' => $kunjunganId,
                    'soap' => $getSoap,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost(),
                ]);
            }

            $soapData = [
                'subjective' => $soap['subjective'],
                'assesment' => $soap['assessment'] == '' ? null : $soap['assessment'],
                'status' => $soap['status'],
            ];

            $this->soapModel->update($id, $soapData);
            session()->setFlashdata('success', 'Data SOAP berhasil diperbarui.');
            return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/soap'));
        }
    }

    public function delete($kunjunganId, $id)
    {
        $this->soapModel->delete($id);
        session()->setFlashdata('success', 'Data SOAP berhasil dihapus.');
        return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/soap'));
    }
}
