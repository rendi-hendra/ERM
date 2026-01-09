<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpOnUnitModel extends Model
{
    protected $table            = 'emp_on_unit';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'emp_id',
        'unit_id',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;

    public function getWithEmployee()
    {
        return $this->select('emp_on_unit.*, employee.nama as nama')
            ->join('employee', 'employee.id = emp_on_unit.emp_id')
            ->orderBy('employee.nama', 'ASC');
    }
}
