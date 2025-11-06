<?php

namespace App\Controllers;

use App\Models\AsuransiModel;

class Asuransi extends BaseController
{
    protected $asuransiModel;
    protected $validation;

    public function __construct()
    {
        $this->asuransiModel = new asuransiModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $asuransiModel = $this->asuransiModel;
        if ($keyword) {
            $asuransiModel = $asuransiModel
                ->like('nama_asuransi', $keyword)
                ->orLike('no_kontak', $keyword);
        }
        $asuransi = $asuransiModel->paginate(10, 'asuransi');
        $pager = $asuransiModel->pager;

        return view('asuransi/index', [
            'asuransi' => $asuransi,
            'pager' => $pager,
        ]);
    }

    public function create()
    {

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'nama_asuransi' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required'   => 'Nama asuransi wajib diisi.',
                        'min_length' => 'Nama asuransi minimal 3 huruf.'
                    ]
                ],
                'no_kontak' => [
                    'rules' => 'required|alpha_numeric|min_length[3]|max_length[10]|is_unique[asuransi.no_kontak]',
                    'errors' => [
                        'required'    => 'No.Kontak wajib diisi.',
                        'alpha_numeric' => 'No.Kontak hanya boleh huruf dan angka.',
                        'min_length'  => 'No.Kontak minimal 3 karakter.',
                        'max_length'  => 'No.Kontak maksimal 10 karakter.',
                        'is_unique'   => 'No.Kontak sudah terdaftar.'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required'   => 'Alamat wajib diisi.',
                        'min_length' => 'Alamat minimal 5 huruf.'
                    ]
                ],
            ];

            if (! $this->validate($rules)) {
                return view('asuransi/form', [
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $this->asuransiModel->save([
                'nama_asuransi'       => $this->request->getPost('nama_asuransi'),
                'no_kontak'           => $this->request->getPost('no_kontak'),
                'alamat'              => $this->request->getPost('alamat'),
            ]);

            return redirect()->to('/asuransi')->with('success', 'Data asuransi berhasil ditambahkan.');
        }

        return view('asuransi/form', [
            'validation' => $this->validator,
        ]);
    }


    public function edit($id)
    {
        $data = [
            'asuransi'     => $this->asuransiModel->find($id),
            'validation' => $this->validation
        ];

        return view('asuransi/form', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_asuransi' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama asuransi wajib diisi.',
                    'min_length' => 'Nama asuransi minimal 3 huruf.'
                ]
            ],
            'no_kontak' => [
                'rules' => "required|alpha_numeric|min_length[3]|max_length[10]|is_unique[asuransi.no_kontak,id,{$id}]",
                'errors' => [
                    'required'    => 'No.Kontak wajib diisi.',
                    'alpha_numeric' => 'No.Kontak hanya boleh huruf dan angka.',
                    'min_length'  => 'No.Kontak minimal 3 karakter.',
                    'max_length'  => 'No.Kontak maksimal 10 karakter.',
                    'is_unique'   => 'No.Kontak sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required'   => 'Alamat wajib diisi.',
                    'min_length' => 'Alamat minimal 5 huruf.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return view('asuransi/form', [
                'validation' => $this->validator,
                'asuransi' => $this->asuransiModel->find($id)
            ]);
        }

        $this->asuransiModel->update($id, [
            'nama_asuransi'       => $this->request->getPost('nama_asuransi'),
            'no_kontak'           => $this->request->getPost('no_kontak'),
            'alamat'              => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/asuransi')->with('success', 'Data asuransi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->asuransiModel->delete($id);
        return redirect()->to('/asuransi')->with('success', 'Data asuransi berhasil dihapus.');
    }
}
