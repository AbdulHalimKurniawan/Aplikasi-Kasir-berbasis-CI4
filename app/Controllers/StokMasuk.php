<?php

namespace App\Controllers;

use App\Models\StokMasukModel;
use App\Models\ProdukModel;
use DateTime;

class StokMasuk extends BaseController
{
    protected StokMasukModel $model;
    protected ProdukModel $produkModel;

    public function __construct()
    {
        $this->model = new StokMasukModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        return view('stok_masuk');
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
        $newStok = max($stok + $jumlah, 0);

        $this->produkModel->update($id, ['stok' => $newStok]);

        $tanggal = new DateTime($this->request->getPost('tanggal'));
        $this->model->insert([
            'tanggal'    => $tanggal->format('Y-m-d H:i:s'),
            'barcode'    => $id,
            'jumlah'     => $jumlah,
            'keterangan' => $this->request->getPost('keterangan'),
            'supplier'   => $this->request->getPost('supplier') ?: null,
        ]);

        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function laporan()
    {
        $data = $this->model->laporan();
        $result = [];
        foreach ($data as $row) {
            $tanggal = new DateTime($row['tanggal']);
            $result[] = [
                'tanggal'     => $tanggal->format('d-m-Y H:i:s'),
                'barcode'     => $row['barcode'],
                'nama_produk' => $row['nama_produk'],
                'jumlah'      => $row['jumlah'],
                'keterangan'  => $row['keterangan'],
                'supplier'    => $row['supplier'] ?? '-',
            ];
        }
        return $this->response->setJSON(['data' => $result]);
    }

    public function stokHari()
    {
        $now = date('d m Y');
        $result = $this->model->stokHari($now);
        $total = $result['total'] ?? 0;
        return $this->response->setJSON(['total' => $total ?: 0]);
    }
}
