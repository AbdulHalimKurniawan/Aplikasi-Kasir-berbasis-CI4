<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class Pengguna extends BaseController
{
    protected PenggunaModel $model;

    public function __construct()
    {
        $this->model = new PenggunaModel();
    }

    public function index()
    {
        return view('pengguna');
    }

    public function read()
    {
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $data = $this->model->getKasirUsers();
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'username' => $row['username'],
                'nama'     => $row['nama'],
                'action'   => '<button class="btn btn-sm btn-success" onclick="edit(' . $row['id'] . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="hapus(' . $row['id'] . ')">Delete</button>',
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function add()
    {
        $this->model->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'role'     => '2',
        ]);
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function delete()
    {
        $this->model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function edit()
    {
        $id = $this->request->getPost('id');
        $this->model->update($id, [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
        ]);
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function getPengguna()
    {
        $row = $this->model->select('id, username, nama')->find((int) $this->request->getPost('id'));
        return $this->response->setJSON($row);
    }
}
