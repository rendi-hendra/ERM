<?php

namespace App\Models;

use CodeIgniter\Model;

class SoapModel extends Model
{
    protected $table            = 'rm_soap';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kunjungan_id',
        'employee_id',
        'subjective',
        'objective',
        'assessment',
        'plan',
        'status',
        'created_at',
        'updated_at',
        'finalized_at'
    ];
    protected $useTimestamps    = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSoapByEmployee($kunjunganId)
    {
        return $this->select('rm_soap.*, employee.nama as employee_name')
            ->where('rm_soap.kunjungan_id', $kunjunganId)
            ->join('employee', 'employee.id = rm_soap.employee_id')
            ->orderBy('rm_soap.created_at', 'DESC');
    }
}
