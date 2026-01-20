<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pemeriksaan extends BaseController
{
    protected $pemeriksaanModel;

    public function __construct()
    {
        $this->pemeriksaanModel = new \App\Models\PemeriksaanModel();
    }

    public function index($kunjunganId)
    {
        $pemeriksaanModel = $this->pemeriksaanModel->getPemeriksaanByKunjungan($kunjunganId);
        $pemeriksaan = $this->pemeriksaanModel->findAll();
        $pager = $pemeriksaanModel->pager;

        return view('kunjungan/pemeriksaan/index', [
            'pemeriksaan' => $pemeriksaan,
            'kunjunganId' => $kunjunganId,
            'pager' => $pager,
        ]);
    }

    public function create($kunjunganId)
    {
        if ($this->request->getMethod() === 'POST') {
            $pemeriksaan = $this->request->getPost();
            $rules = [
                'suhu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Suhu wajib diisi.'
                    ]
                ],
                'td_sistolik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tekanan Darah sistolik wajib diisi.'
                    ]
                ],
                'td_diastolik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tekanan Darah diastolik Suhu wajib diisi.'
                    ]
                ],
                'nadi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nadi wajib diisi.'
                    ]
                ],
                'rr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Respiratory Rate wajib diisi.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return view('kunjungan/pemeriksaan/form', [
                    'kunjunganId' => $kunjunganId,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $pemeriksaanData = [
                'kunjungan_id' => $kunjunganId,
                'employee_id' => session()->get('employee_id'),
                'suhu' => $pemeriksaan['suhu'],
                'td_sistolik' => $pemeriksaan['td_sistolik'],
                'td_diastolik' => $pemeriksaan['td_diastolik'],
                'nadi' => $pemeriksaan['nadi'],
                'rr' => $pemeriksaan['rr'],
                'berat_badan' => $pemeriksaan['berat_badan'],
                'tinggi_badan' => $pemeriksaan['tinggi_badan'],
                'catatan' => $pemeriksaan['catatan']
            ];

            $this->pemeriksaanModel->insert($pemeriksaanData);
            session()->setFlashdata('success', 'Data pemeriksaan berhasil ditambahkan.');
            return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/pemeriksaan'));
        }

        return view('kunjungan/pemeriksaan/form', [
            'kunjunganId' => $kunjunganId,
        ]);
    }

    public function edit($kunjunganId, $id)
    {
        $pemeriksaan = $this->pemeriksaanModel->find($id);

        return view('kunjungan/pemeriksaan/form', [
            'kunjunganId' => $kunjunganId,
            'pemeriksaan' => $pemeriksaan
        ]);
    }

    public function update($kunjunganId, $id)
    {
        if ($this->request->getMethod() == 'POST') {
            $pemeriksaan = $this->request->getPost();

            $rules = [
                'suhu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Suhu wajib diisi.'
                    ]
                ],
                'td_sistolik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tekanan Darah sistolik wajib diisi.'
                    ]
                ],
                'td_diastolik' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tekanan Darah diastolik Suhu wajib diisi.'
                    ]
                ],
                'nadi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nadi wajib diisi.'
                    ]
                ],
                'rr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Respiratory Rate wajib diisi.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return view('kunjungan/pemeriksaan/form', [
                    'kunjunganId' => $kunjunganId,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $pemeriksaanData = [
                'kunjungan_id' => $kunjunganId,
                'suhu' => $pemeriksaan['suhu'],
                'td_sistolik' => $pemeriksaan['td_sistolik'],
                'td_diastolik' => $pemeriksaan['td_diastolik'],
                'nadi' => $pemeriksaan['nadi'],
                'rr' => $pemeriksaan['rr'],
                'berat_badan' => $pemeriksaan['berat_badan'],
                'tinggi_badan' => $pemeriksaan['tinggi_badan'],
                'catatan' => $pemeriksaan['catatan']
            ];

            $this->pemeriksaanModel->update($id, $pemeriksaanData);

            session()->setFlashdata('success', 'Data pemeriksaan berhasil diperbarui.');
            return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/pemeriksaan'));
        }
    }

    public function delete($kunjunganId, $id)
    {
        $this->pemeriksaanModel->delete($id);
        session()->setFlashdata('success', 'Data pemeriksaan berhasil dihapus.');
        return redirect()->to(base_url('/kunjungan/' . $kunjunganId . '/pemeriksaan'));
    }
}
