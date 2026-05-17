<?php

namespace App\Models;

use CodeIgniter\Model;

class StokKeluarModel extends Model
{
    protected $table = 'stok_keluar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'barcode', 'jumlah', 'keterangan'];

    public function getAll(): array
    {
        return $this->select('stok_keluar.tanggal, stok_keluar.jumlah, stok_keluar.keterangan, produk.barcode, produk.nama_produk')
            ->join('produk', 'produk.id = stok_keluar.barcode')
            ->findAll();
    }
}
