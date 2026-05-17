<?php

namespace App\Controllers;

use App\Models\SatuanProdukModel;

class SatuanProduk extends BaseController
{
    protected SatuanProdukModel $model;

    public function __construct()
    {
        $this->model = new SatuanProdukModel();
    }

    public function index()
    {
        return view('satuan_produk');
    }

    public function read()
    {
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $data = $this->model->findAll();
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'satuan' => $row['satuan'],
                'action' => '<button class="btn btn-sm btn-success" onclick="edit(' . $row['id'] . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="hapus(' . $row['id'] . ')">Delete</button>',
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function add()
    {
        $this->model->insert(['satuan' => $this->request->getPost('satuan')]);
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
        $this->model->update($id, ['satuan' => $this->request->getPost('satuan')]);
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function getSatuan()
    {
        $row = $this->model->find($this->request->getPost('id'));
        return $this->response->setJSON($row);
    }

    public function search()
    {
        $keyword = $this->request->getPost('satuan') ?? '';
        $results = $this->model->search($keyword);
        $data = [];
        foreach ($results as $row) {
            $data[] = ['id' => $row['id'], 'text' => $row['satuan']];
        }
        return $this->response->setJSON($data);
    }
}
