<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanProdukModel extends Model
{
    protected $table = 'satuan_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['satuan'];

    public function search(string $keyword = ''): array
    {
        return $this->like('satuan', $keyword)->findAll();
    }
}
