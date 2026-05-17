<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\TokoModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('status') === 'login') {
            return redirect()->to(session()->get('role') === 'admin' ? '/dashboard' : '/transaksi');
        }

        if ($this->request->getMethod() === 'POST' && $this->request->getPost('username')) {
            $username = $this->request->getPost('username');
            $model = new PenggunaModel();
            $user = $model->getByUsername($username);

            if (!$user) {
                return $this->response->setJSON('tidakada');
            }

            if (!password_verify($this->request->getPost('password'), $user['password'])) {
                return $this->response->setJSON('passwordsalah');
            }

            $toko = (new TokoModel())->getToko();
            session()->set([
                'id'       => $user['id'],
                'username' => $user['username'],
                'nama'     => $user['nama'],
                'role'     => $user['role'] === '1' ? 'admin' : 'kasir',
                'status'   => 'login',
                'toko'     => $toko,
            ]);

            $redirect = $user['role'] === '1' ? site_url('/dashboard') : site_url('/transaksi');
            return $this->response->setJSON(['status' => 'sukses', 'redirect' => $redirect]);
        }

        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
