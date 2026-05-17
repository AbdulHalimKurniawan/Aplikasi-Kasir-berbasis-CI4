<?php

namespace App\Controllers;

use App\Models\KategoriProdukModel;

class KategoriProduk extends BaseController
{
    protected KategoriProdukModel $model;

    public function __construct()
    {
        $this->model = new KategoriProdukModel();
    }

    public function index()
    {
        return view('kategori_produk');
    }

    public function read()
    {
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $data = $this->model->findAll();
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'kategori' => $row['kategori'],
                'action'   => '<button class="btn btn-sm btn-success" onclick="edit(' . $row['id'] . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="hapus(' . $row['id'] . ')">Delete</button>',
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function add()
    {
        $this->model->insert(['kategori' => $this->request->getPost('kategori')]);
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
        $this->model->update($id, ['kategori' => $this->request->getPost('kategori')]);
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function getKategori()
    {
        $row = $this->model->find($this->request->getPost('id'));
        return $this->response->setJSON($row);
    }

    public function search()
    {
        $keyword = $this->request->getPost('kategori') ?? '';
        $results = $this->model->search($keyword);
        $data = [];
        foreach ($results as $row) {
            $data[] = ['id' => $row['id'], 'text' => $row['kategori']];
        }
        return $this->response->setJSON($data);
    }
}
