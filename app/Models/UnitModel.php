<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'unit';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama',
        'kategori',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;

    public function getEmployeesOnUnit($unitId)
    {
        return $this->select('emp_on_unit.*, employee.nama as nama_employee, employee.sip, employee.jenis, employee.no_hp')
            ->join('emp_on_unit', 'emp_on_unit.unit_id = unit.id')
            ->join('employee', 'employee.id = emp_on_unit.emp_id')
            ->where('unit.id', $unitId)
            ->orderBy('employee.nama', 'ASC');
    }
}
