<?php

namespace App\Controllers;

use App\Models\UnitModel;
use App\Models\PasienModel;
use App\Models\AsuransiModel;
use App\Models\EmpOnUnitModel;
use App\Models\KunjunganModel;
use App\Models\AsuransiPasienModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Kunjungan extends BaseController
{
    protected $kunjunganModel;
    protected $pasienModel;
    protected $asuransiModel;
    protected $asuransiPasienModel;
    protected $unitModel;
    protected $empOnUnitModel;
    protected $validation;
    protected $rules = [
        'pasien_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Pasien wajib dipilih.',
                'integer'  => 'ID pasien tidak valid.',
            ]
        ],
        'asuransi_pasien_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Asuransi wajib dipilih.',
                'integer'  => 'ID asuransi tidak valid.',
            ]
        ],
        'unit_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Unit wajib dipilih.',
                'integer'  => 'ID unit tidak valid.',
            ]
        ],
        'emp_on_unit_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Dokter wajib dipilih.',
                'integer'  => 'ID dokter tidak valid.',
            ]
        ],
        'tanggal_kunjungan' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Tanggal kunjungan wajib diisi.',
                'valid_date'  => 'Tanggal kunjungan tidak valid.',
            ]
        ],
        'metode_pembayaran' => [
            'rules' => 'required|string',
            'errors' => [
                'required' => 'Metode pembayaran wajib diisi.',
                'string'  => 'Metode pembayaran tidak valid.',
            ]
        ],
        'keluhan' => [
            'rules' => 'required|string|max_length[255]',
            'errors' => [
                'required' => 'Keluhan wajib diisi.',
                'string'  => 'Keluhan tidak valid.',
            ]
        ],
    ];

    public function __construct()
    {
        $this->kunjunganModel = new KunjunganModel();
        $this->pasienModel = new PasienModel();
        $this->asuransiModel = new AsuransiModel();
        $this->asuransiPasienModel = new AsuransiPasienModel();
        $this->unitModel = new UnitModel();
        $this->empOnUnitModel = new EmpOnUnitModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $kunjunganModel = $this->kunjunganModel->getWithRelations();

        if ($keyword) {
            $kunjunganModel = $kunjunganModel->search($keyword);
        }

        $kunjungan = $kunjunganModel->paginate(10, 'kunjungan');
        $pager = $this->kunjunganModel->pager;

        return view('kunjungan/index', [
            'kunjungan' => $kunjungan,
            'pager' => $pager,
            'keyword' => $keyword,
            'validator' => $this->validation
        ]);
    }

    public function dokterByUnit($unitId)
    {
        $empOnUnit = $this->empOnUnitModel->getWithEmployee()
            ->where('unit_id', $unitId)
            ->findAll();

        return $this->response->setJSON($empOnUnit);
    }


    public function create()
    {

        $pasien = $this->pasienModel->select()->findAll();
        $asuransi = $this->asuransiModel->select()->findAll();
        $unit = $this->unitModel->select()->findAll();
        $empOnUnit = $this->empOnUnitModel->getWithEmployee()->findAll();


        $asuransiPasien = $this->asuransiPasienModel->select('asuransi_pasien.*, pasien.nik as nik, pasien.nama as nama_pasien, asuransi.nama_asuransi')
            ->join('pasien', 'pasien.id = asuransi_pasien.pasien_id')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
            ->findAll();

        if ($this->request->getMethod() === 'POST') {

            $rules = $this->rules;

            if (! $this->validate($rules)) {
                return view('kunjungan/form', [
                    'asuransi_pasien' => $asuransiPasien,
                    'asuransi' => $asuransi,
                    'pasien' => $pasien,
                    'unit' => $unit,
                    'empOnUnit' => $empOnUnit,
                    'validation' => $this->validator,
                    'oldInput' => $this->request->getPost()
                ]);
            }

            $this->kunjunganModel->save([
                'pasien_id'             => $this->request->getPost('pasien_id'),
                'asuransi_pasien_id'    => $this->request->getPost('asuransi_pasien_id'),
                'unit_id'               => $this->request->getPost('unit_id'),
                'dpjp'                  => $this->request->getPost('emp_on_unit_id'),
                'tanggal_kunjungan'       => $this->request->getPost('tanggal_kunjungan'),
                'metode_pembayaran'       => $this->request->getPost('metode_pembayaran'),
                'keluhan'               => $this->request->getPost('keluhan'),
            ]);

            return redirect()->to('/kunjungan')->with('success', 'Data kunjungan pasien berhasil ditambahkan.');
        }

        return view('kunjungan/form', [
            'asuransi_pasien' => $asuransiPasien,
            'asuransi' => $asuransi,
            'pasien' => $pasien,
            'unit' => $unit,
            'empOnUnit' => $empOnUnit,
            'kunjungan' => null,
            'validation' => $this->validator,
        ]);
    }


    public function edit($id)
    {
        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();
        $kunjungan = $this->kunjunganModel->getWithRelations()->find($id);
        $unit = $this->unitModel->select()->findAll();
        $empOnUnit = $this->empOnUnitModel->getWithEmployee()->findAll();

        $asuransiPasien = $this->asuransiPasienModel
            ->select('asuransi_pasien.id, asuransi.nama_asuransi')
            ->join('asuransi', 'asuransi.id = asuransi_pasien.asuransi_id')
            ->where('asuransi_pasien.pasien_id', $id)
            ->findAll();

        return view('kunjungan/form', [
            'asuransi_pasien' => $asuransiPasien,
            'kunjungan' => $kunjungan,
            'asuransi' => $asuransi,
            'pasien' => $pasien,
            'unit' => $unit,
            'empOnUnit' => $empOnUnit,
            'validation' => $this->validation
        ]);
    }

    public function update($id)
    {
        $pasien = $this->pasienModel->select('id,nik,nama')->findAll();
        $asuransi = $this->asuransiModel->select('id,nama_asuransi')->findAll();
        $kunjungan = $this->kunjunganModel->find($id);
        $unit = $this->unitModel->select()->findAll();
        $rules = $this->rules;

        if (! $this->validate($rules)) {
            return view('kunjungan/form', [
                'kunjungan' => $kunjungan,
                'asuransi' => $asuransi,
                'pasien' => $pasien,
                'unit' => $unit,
                'validation' => $this->validator,
                'oldInput' => $this->request->getPost()
            ]);
        }

        $this->kunjunganModel->update($id, [
            'pasien_id'             => $this->request->getPost('pasien_id'),
            'asuransi_pasien_id'    => $this->request->getPost('asuransi_pasien_id'),
            'unit_id'               => $this->request->getPost('unit_id'),
            'dpjp'                  => $this->request->getPost('emp_on_unit_id'),
            'tanggal_kunjungan'       => $this->request->getPost('tanggal_kunjungan'),
            'metode_pembayaran'       => $this->request->getPost('metode_pembayaran'),
            'keluhan'               => $this->request->getPost('keluhan'),
        ]);

        return redirect()->to('/kunjungan')->with('success', 'Data kunjungan pasien berhasil diperbarui.');
    }

    public function delete($id)
    {
        $data = $this->kunjunganModel->find($id);

        if (!$data) {
            throw new PageNotFoundException();
        }

        $this->kunjunganModel->delete($id);
        return redirect()->to('/kunjungan')->with('success', 'Data kunjungan pasien berhasil dihapus.');
    }
}
