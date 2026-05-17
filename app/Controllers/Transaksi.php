<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\ProdukModel;
use DateTime;

class Transaksi extends BaseController
{
    protected TransaksiModel $model;
    protected ProdukModel $produkModel;

    public function __construct()
    {
        $this->model = new TransaksiModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        return view('transaksi');
    }

    public function read()
    {
        $transaksis = $this->model->getAll();
        $data = [];
        foreach ($transaksis as $t) {
            $barcodes = explode(',', $t['barcode']);
            $qtys = explode(',', $t['qty']);
            $tanggal = new DateTime($t['tanggal']);

            // Build product names
            $namaProduk = '<table>';
            foreach ($barcodes as $key => $bid) {
                $produk = $this->produkModel->select('nama_produk')->find((int) $bid);
                $qty = $qtys[$key] ?? 0;
                $namaProduk .= '<tr><td>' . ($produk['nama_produk'] ?? '') . ' (' . $qty . ')</td></tr>';
            }
            $namaProduk .= '</table>';

            $data[] = [
                'tanggal'     => $tanggal->format('d-m-Y H:i:s'),
                'nama_produk' => $namaProduk,
                'total_bayar' => $t['total_bayar'],
                'jumlah_uang' => $t['jumlah_uang'],
                'diskon'      => $t['diskon'],
                'pelanggan'   => $t['pelanggan'] ?? '-',
                'action'      => '<a class="btn btn-sm btn-success" href="' . site_url('transaksi/cetak/' . $t['id']) . '">Print</a> <button class="btn btn-sm btn-danger" onclick="hapus(' . $t['id'] . ')">Delete</button>',
            ];
        }
        return $this->response->setJSON(['data' => $data]);
    }

    public function add()
    {
        $produkData = json_decode($this->request->getPost('produk'), true);
        $tanggal = new DateTime($this->request->getPost('tanggal'));
        $barcodes = [];

        foreach ($produkData as $p) {
            $this->produkModel->update($p['id'], ['stok' => $p['stok'], 'terjual' => $p['terjual']]);
            $barcodes[] = $p['id'];
        }

        $data = [
            'tanggal'     => $tanggal->format('Y-m-d H:i:s'),
            'barcode'     => implode(',', $barcodes),
            'qty'         => implode(',', $this->request->getPost('qty')),
            'total_bayar' => $this->request->getPost('total_bayar'),
            'jumlah_uang' => $this->request->getPost('jumlah_uang'),
            'diskon'      => $this->request->getPost('diskon') ?? '',
            'pelanggan'   => $this->request->getPost('pelanggan'),
            'nota'        => $this->request->getPost('nota'),
            'kasir'       => session()->get('id'),
        ];

        $this->model->insert($data);
        return $this->response->setJSON($this->model->getInsertID());
    }

    public function delete()
    {
        $this->model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'sukses']);
    }

    public function cetak(int $id)
    {
        $transaksi = $this->model->getTransaksi($id);
        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tanggal = new DateTime($transaksi['tanggal']);
        $barcodes = explode(',', $transaksi['barcode']);
        $qtys = explode(',', $transaksi['qty']);

        $produkList = [];
        foreach ($barcodes as $key => $bid) {
            $p = $this->produkModel->select('nama_produk, harga')->find((int) $bid);
            if ($p) {
                $produkList[] = [
                    'nama_produk' => $p['nama_produk'],
                    'total'       => $qtys[$key] ?? 0,
                    'harga'       => (int) $p['harga'] * (int) ($qtys[$key] ?? 0),
                ];
            }
        }

        return view('cetak', [
            'nota'      => $transaksi['nota'],
            'tanggal'   => $tanggal->format('d m Y H:i:s'),
            'produk'    => $produkList,
            'total'     => $transaksi['total_bayar'],
            'bayar'     => $transaksi['jumlah_uang'],
            'kembalian' => (int) $transaksi['jumlah_uang'] - (int) $transaksi['total_bayar'],
            'kasir'     => $transaksi['kasir'],
        ]);
    }

    public function penjualanBulan()
    {
        $days = $this->request->getPost('day');
        $data = [];
        if ($days) {
            foreach ($days as $day) {
                $date = date($day . ' m Y');
                $result = $this->model->penjualanBulan($date);
                $data[] = !empty($result) ? array_sum($result) : 0;
            }
        }
        return $this->response->setJSON($data);
    }

    public function transaksiHari()
    {
        $now = date('d m Y');
        $total = $this->model->transaksiHari($now);
        return $this->response->setJSON(['total' => $total]);
    }

    public function transaksiTerakhir()
    {
        $now = date('d m Y');
        $qty = $this->model->transaksiTerakhir($now);
        $result = $qty ? explode(',', $qty) : [];
        return $this->response->setJSON($result);
    }
}
