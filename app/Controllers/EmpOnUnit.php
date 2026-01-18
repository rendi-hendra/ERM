<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmpOnUnit extends BaseController
{
    protected $empOnUnitModel;
    protected $employeesModel;

    public function __construct()
    {
        $this->empOnUnitModel = new \App\Models\EmpOnUnitModel();
        $this->employeesModel = new \App\Models\EmployeesModel();
    }

    public function getEmployees($unit_id): ResponseInterface
    {
        $usedEmpIds = $this->empOnUnitModel
            ->where('unit_id', $unit_id)
            ->select('emp_id')
            ->findColumn('emp_id');

        $employees = $this->employeesModel
            ->where('jenis', 'dokter')
            ->whereNotIn('id', $usedEmpIds ?? [])
            ->orderBy('nama', 'ASC')
            ->findAll();

        return $this->response->setJSON($employees);
    }

    public function create($unit_id)
    {
        $employeeId = $this->request->getPost('employee');

        if (! $employeeId) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['employee' => 'Employee wajib dipilih.']);
        }

        // CEK UNIQUE PER UNIT
        $exists = $this->empOnUnitModel
            ->where('unit_id', $unit_id)
            ->where('emp_id', $employeeId)
            ->first();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('errors', [
                    'employee' => 'Employee sudah ditambahkan ke unit ini.'
                ]);
        }

        $this->empOnUnitModel->insert([
            'unit_id' => $unit_id,
            'emp_id'  => $employeeId,
        ]);

        return redirect()
            ->to(base_url('unit/edit/' . $unit_id))
            ->with('success', 'Employee berhasil ditambahkan ke unit.');
    }


    public function edit($unit_id, $emp_on_unit_id)
    {
        return view('unit/emp_on_unit/form', [
            'unit_id' => $unit_id,
            'emp_on_unit_id' => $emp_on_unit_id
        ]);
    }

    public function update($unit_id, $emp_on_unit_id)
    {
        $rules = [
            'employee' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->empOnUnitModel->update($emp_on_unit_id, [
            'emp_id' => $this->request->getPost('employee'),
        ]);

        return redirect()->to(base_url('unit/edit/' . $unit_id));
    }

    public function delete($unit_id, $emp_on_unit_id)
    {
        $this->empOnUnitModel->delete($emp_on_unit_id);

        return redirect()->to(base_url('unit/edit/' . $unit_id));
    }
}
