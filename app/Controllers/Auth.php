<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'POST') {
            $userModel = new UserModel();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');


            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'logged_in' => true,
                    'user_id'   => $user['id'],
                    'employee_id' => $user['id_employee'],
                    'username'  => $user['username'],
                    'nama'      => $user['employee_nama'],
                    'role'      => $user['role']
                ]);
                return redirect()->to('/pasien');
            } else {
                return redirect()->back()->with('error', 'Username atau password salah');
            }
        }

        if (session()->get('logged_in')) {
            return redirect()->to('/pasien');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
