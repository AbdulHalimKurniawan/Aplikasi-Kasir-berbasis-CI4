<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jenis_kelamin', 'alamat', 'telepon'];

    public function search(string $keyword = ''): array
    {
        return $this->like('nama', $keyword)->findAll();
    }
}
