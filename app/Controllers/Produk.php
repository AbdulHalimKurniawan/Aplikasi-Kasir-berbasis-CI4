<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected ProdukModel $model;

    public function __construct()
    {
        $this->model = new ProdukModel();
    }

    public function index()
    {
        return view('produk');
    }

    public function read()
    {
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $data = $this->model->getAll();
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'barcode'  => $row['barcode'],
                'nama'     => $row['nama_produk'],
                'kategori' => $row['kategori'],
                'satuan'   => $row['satuan'],
                'harga'    => $row['harga'],
                'stok'     => $row['stok'],
                'action'   => '<button class="btn btn-sm btn-success" onclick="edit(' . $row['id'] . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="hapus(' . $row['id'] . ')">Delete</button>',
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function add()
    {
        $data = [
            'barcode'     => $this->request->getPost('barcode'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'satuan'      => $this->request->getPost('satuan'),
            'kategori'    => $this->request->getPost('kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'terjual'     => '0',
        ];
        $this->model->insert($data);
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
            'barcode'     => $this->request->getPost('barcode'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'satuan'      => $this->request->getPost('satuan'),
            'kategori'    => $this->request->getPost('kategori'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
        ]);
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function getProduk()
    {
        $row = $this->model->getProduk((int) $this->request->getPost('id'));
        return $this->response->setJSON($row);
    }

    public function getBarcode()
    {
        $keyword = $this->request->getPost('barcode') ?? '';
        $results = $this->model->searchBarcode($keyword);
        $data = [];
        foreach ($results as $row) {
            $data[] = ['id' => $row['id'], 'text' => $row['barcode']];
        }
        return $this->response->setJSON($data);
    }

    public function getNama()
    {
        $row = $this->model->select('nama_produk, stok')->find((int) $this->request->getPost('id'));
        return $this->response->setJSON($row);
    }

    public function getStok()
    {
        $row = $this->model->select('stok, nama_produk, harga, barcode')->find((int) $this->request->getPost('id'));
        return $this->response->setJSON($row);
    }

    public function produkTerlaris()
    {
        $produk = $this->model->produkTerlaris();
        $label = array_column($produk, 'nama_produk');
        $data = array_column($produk, 'terjual');
        return $this->response->setJSON(['label' => $label, 'data' => $data]);
    }

    public function dataStok()
    {
        return $this->response->setJSON($this->model->dataStok());
    }
}
