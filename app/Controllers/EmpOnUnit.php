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
        $mode     = $this->request->getGet('mode') ?? 'create';
        $selected = $this->request->getGet('selected');

        // ambil employee yang sudah ada di unit
        $usedEmpIds = $this->empOnUnitModel
            ->where('unit_id', $unit_id)
            ->select('emp_id')
            ->findColumn('emp_id') ?? [];

        // MODE EDIT → kecualikan employee yang sedang diedit
        if ($mode === 'edit' && $selected) {
            $usedEmpIds = array_diff($usedEmpIds, [$selected]);
        }

        $query = $this->employeesModel
            ->where('jenis', 'dokter');

        if (! empty($usedEmpIds)) {
            $query->whereNotIn('id', $usedEmpIds);
        }

        return $this->response->setJSON(
            $query->orderBy('nama', 'ASC')->findAll()
        );
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
