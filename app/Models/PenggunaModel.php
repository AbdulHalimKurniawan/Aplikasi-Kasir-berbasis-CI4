<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama', 'role'];

    public function getByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }

    public function getKasirUsers(): array
    {
        return $this->where('role', '2')->findAll();
    }
}
