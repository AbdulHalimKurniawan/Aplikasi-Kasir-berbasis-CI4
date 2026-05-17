<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['barcode', 'nama_produk', 'kategori', 'satuan', 'harga', 'stok', 'terjual'];

    public function getAll(): array
    {
        return $this->select('produk.id, produk.barcode, produk.nama_produk, produk.harga, produk.stok, kategori_produk.kategori, satuan_produk.satuan')
            ->join('kategori_produk', 'produk.kategori = kategori_produk.id')
            ->join('satuan_produk', 'produk.satuan = satuan_produk.id')
            ->findAll();
    }

    public function getProduk(int $id): ?array
    {
        return $this->select('produk.id, produk.barcode, produk.nama_produk, produk.harga, produk.stok, kategori_produk.id as kategori_id, kategori_produk.kategori, satuan_produk.id as satuan_id, satuan_produk.satuan')
            ->join('kategori_produk', 'produk.kategori = kategori_produk.id')
            ->join('satuan_produk', 'produk.satuan = satuan_produk.id')
            ->where('produk.id', $id)
            ->first();
    }

    public function searchBarcode(string $keyword = ''): array
    {
        return $this->select('id, barcode')->like('barcode', $keyword)->findAll();
    }

    public function produkTerlaris(): array
    {
        return $this->db->query('SELECT nama_produk, terjual FROM produk ORDER BY CONVERT(terjual, DECIMAL) DESC LIMIT 5')->getResultArray();
    }

    public function dataStok(): array
    {
        return $this->db->query('SELECT nama_produk, stok FROM produk ORDER BY CONVERT(stok, DECIMAL) DESC LIMIT 50')->getResultArray();
    }
}
