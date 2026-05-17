<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected PelangganModel $model;

    public function __construct()
    {
        $this->model = new PelangganModel();
    }

    public function index()
    {
        return view('pelanggan');
    }

    public function read()
    {
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $data = $this->model->findAll();
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'nama'          => $row['nama'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'alamat'        => $row['alamat'],
                'telepon'       => $row['telepon'],
                'action'        => '<button class="btn btn-sm btn-success" onclick="edit(' . $row['id'] . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="hapus(' . $row['id'] . ')">Delete</button>',
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function add()
    {
        $this->model->insert([
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat'        => $this->request->getPost('alamat'),
            'telepon'       => $this->request->getPost('telepon'),
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
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat'        => $this->request->getPost('alamat'),
            'telepon'       => $this->request->getPost('telepon'),
        ]);
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function getPelanggan()
    {
        $row = $this->model->find($this->request->getPost('id'));
        return $this->response->setJSON($row);
    }

    public function search()
    {
        $keyword = $this->request->getPost('pelanggan') ?? '';
        $results = $this->model->search($keyword);
        $data = [];
        foreach ($results as $row) {
            $data[] = ['id' => $row['id'], 'text' => $row['nama']];
        }
        return $this->response->setJSON($data);
    }
}
