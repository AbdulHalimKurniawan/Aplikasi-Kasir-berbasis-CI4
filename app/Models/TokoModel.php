<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table = 'toko';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'alamat'];

    public function getToko(): ?array
    {
        return $this->first();
    }
}
