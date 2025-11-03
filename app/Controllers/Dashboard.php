<?php

namespace App\Controllers;

use App\Models\PasienModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek apakah sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Ambil total pasien dari database
        $pasienModel = new PasienModel();
        $totalPasien = $pasienModel->countAllResults();

        // Kirim data ke view
        $data = [
            'title' => 'Dashboard',
            'totalPasien' => $totalPasien
        ];

        return view('dashboard/index', $data);
    }
}
