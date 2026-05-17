<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProdukModel extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori'];

    public function search(string $keyword = ''): array
    {
        return $this->like('kategori', $keyword)->findAll();
    }
}
