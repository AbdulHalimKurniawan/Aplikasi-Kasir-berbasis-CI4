<?php

namespace App\Models;

use CodeIgniter\Model;

class StokMasukModel extends Model
{
    protected $table = 'stok_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'barcode', 'jumlah', 'keterangan', 'supplier'];

    public function getAll(): array
    {
        return $this->select('stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.keterangan, produk.barcode, produk.nama_produk')
            ->join('produk', 'produk.id = stok_masuk.barcode')
            ->findAll();
    }

    public function laporan(): array
    {
        return $this->select('stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.keterangan, produk.barcode, produk.nama_produk, supplier.nama as supplier')
            ->join('produk', 'produk.id = stok_masuk.barcode')
            ->join('supplier', 'supplier.id = stok_masuk.supplier', 'left')
            ->findAll();
    }

    public function stokHari(string $date): ?array
    {
        return $this->db->query("SELECT SUM(jumlah) AS total FROM stok_masuk WHERE DATE_FORMAT(tanggal, '%d %m %Y') = ?", [$date])->getRowArray();
    }
}
