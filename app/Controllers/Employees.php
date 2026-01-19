<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Employees extends BaseController
{
    protected $employeesModel;
    protected $validation;

    public function __construct()
    {
        $this->employeesModel = new \App\Models\EmployeesModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $employees = $this->employeesModel->orderBy('nama', 'ASC')->findAll();
        $keyword = $this->request->getGet('keyword');
        $employeesModel = $this->employeesModel;
        if ($keyword) {
            $employeesModel = $employeesModel
                ->like('nama', $keyword)
                ->orLike('sip', $keyword);
        }

        $employees = $employeesModel->paginate(10, 'employees');
        $pager = $employeesModel->pager;


        return view('employees/index', [
            'pager' => $pager,
            'keyword' => $keyword,
            'employees' => $employees,
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'sip' => [
                    'rules' => 'required|is_unique[employee.sip]',
                    'errors' => [
                        'required'   => 'SIP wajib diisi.',
                        'is_unique' => 'SIP sudah terdaftar.'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama wajib diisi.'],
                ],
                'jenis' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Jenis wajib diisi.'],
                ],
                'no_hp' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'No. HP wajib diisi.'],
                ],
            ];

            if (!$this->validate($rules)) {
                return view('employees/form', [
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost(),
                ]);
            }

            $this->employeesModel->insert([
                'sip' => $this->request->getPost('sip'),
                'nama' => $this->request->getPost('nama'),
                'jenis' => $this->request->getPost('jenis'),
                'no_hp' => $this->request->getPost('no_hp'),
            ]);

            return redirect()->to(base_url('employees'))->with('success', 'Data employees berhasil ditambahkan.');
        }

        return view('employees/form', [
            'validation' => $this->validator,
        ]);
    }

    public function edit($id)
    {
        $employee = $this->employeesModel->find($id);

        return view('employees/form', [
            'employee' => $employee,
            'validation' => $this->validation,
            'oldInput' => $this->request->getPost(),
        ]);
    }

    public function update($id)
    {
        $rules = [
            'sip' => [
                'rules' => "required|is_unique[employee.sip,id,{$id}]",
                'errors' => [
                    'required'   => 'SIP wajib diisi.',
                    'is_unique' => 'SIP sudah terdaftar.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama wajib diisi.'],
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => ['required' => 'Jenis wajib diisi.'],
            ],
            'no_hp' => [
                'rules' => 'required',
                'errors' => ['required' => 'No. HP wajib diisi.'],
            ],
        ];

        if (! $this->validate($rules)) {
            return view('employees/form', [
                'employee' => $this->employeesModel->find($id),
                'validation' => $this->validator,
                'oldInput' => $this->request->getPost(),
            ]);
        }

        $this->employeesModel->update($id, [
            'sip' => $this->request->getPost('sip'),
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis'),
            'no_hp' => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to(base_url('employees'))->with('success', 'Data employees berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->employeesModel->delete($id);
        return redirect()->to(base_url('employees'))->with('success', 'Data employees berhasil dihapus.');
    }
}
