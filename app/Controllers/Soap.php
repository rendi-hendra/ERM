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

    public function create($kunjunganId)
    {
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
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $soapData = [
                'kunjungan_id' => $kunjunganId,
                'employee_id' => session()->get('employee_id'),
                'subjective' => $soap['subjective'],
                'assesment' => $soap['assessment'] ?? null,
                'status' => $soap['status'],
            ];

            $this->soapModel->insert($soapData);
            session()->setFlashdata('success', 'Data SOAP berhasil ditambahkan.');
            return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/soap'));
        }

        return view('kunjungan/soap/form', ['kunjunganId' => $kunjunganId]);
    }

    public function edit($kunjunganId, $id)
    {
        $soap = $this->soapModel->find($id);

        return view('kunjungan/soap/form', [
            'kunjunganId' => $kunjunganId,
            'soap' => $soap
        ]);
    }

    public function update($kunjunganId, $id)
    {
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
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $soapData = [
                'subjective' => $soap['subjective'],
                'assesment' => $soap['assessment'] ?? null,
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
