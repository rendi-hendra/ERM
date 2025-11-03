<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);

        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $userModel = new UserModel();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');


            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'logged_in' => true,
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role'      => $user['role']
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Username atau password salah');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
