<?php

namespace App\Controllers;

use App\Models\StokKeluarModel;
use App\Models\ProdukModel;
use DateTime;

class StokKeluar extends BaseController
{
    protected StokKeluarModel $model;
    protected ProdukModel $produkModel;

    public function __construct()
    {
        $this->model = new StokKeluarModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        return view('stok_keluar');
    }

    public function read()
    {
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $data = $this->model->getAll();
        $result = [];
        foreach ($data as $row) {
            $tanggal = new DateTime($row['tanggal']);
            $result[] = [
                'tanggal'     => $tanggal->format('d-m-Y H:i:s'),
                'barcode'     => $row['barcode'],
                'nama_produk' => $row['nama_produk'],
                'jumlah'      => $row['jumlah'],
                'keterangan'  => $row['keterangan'],
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function add()
    {
        $id = (int) $this->request->getPost('barcode');
        $jumlah = (int) $this->request->getPost('jumlah');
        $produk = $this->produkModel->select('stok')->find($id);
        $stok = (int) ($produk['stok'] ?? 0);
        $newStok = max($stok - $jumlah, 0);

        $this->produkModel->update($id, ['stok' => $newStok]);

        $tanggal = new DateTime($this->request->getPost('tanggal'));
        $this->model->insert([
            'tanggal'    => $tanggal->format('Y-m-d H:i:s'),
            'barcode'    => $id,
            'jumlah'     => $jumlah,
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return $this->response->setJSON(['status' => 'sukses']);
    }
}
