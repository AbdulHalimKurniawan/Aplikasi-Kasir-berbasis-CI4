<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'alamat', 'telepon', 'keterangan'];

    public function search(string $keyword = ''): array
    {
        return $this->like('nama', $keyword)->findAll();
    }
}
