<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'barcode', 'qty', 'total_bayar', 'jumlah_uang', 'diskon', 'pelanggan', 'nota', 'kasir'];

    public function getAll(): array
    {
        return $this->select('transaksi.id, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, transaksi.diskon, pelanggan.nama as pelanggan')
            ->join('pelanggan', 'transaksi.pelanggan = pelanggan.id', 'left')
            ->findAll();
    }

    public function getTransaksi(int $id): ?array
    {
        return $this->select('transaksi.nota, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, pengguna.nama as kasir')
            ->join('pengguna', 'transaksi.kasir = pengguna.id')
            ->where('transaksi.id', $id)
            ->first();
    }

    public function penjualanBulan(string $date): array
    {
        $result = $this->db->query("SELECT qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = ?", [$date])->getResultArray();
        $data = [];
        foreach ($result as $row) {
            $qtys = explode(',', $row['qty']);
            $data[] = array_sum(array_map('intval', $qtys));
        }
        return $data;
    }

    public function transaksiHari(string $date): int
    {
        $row = $this->db->query("SELECT COUNT(*) AS total FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = ?", [$date])->getRowArray();
        return (int) ($row['total'] ?? 0);
    }

    public function transaksiTerakhir(string $date): ?string
    {
        $row = $this->db->query("SELECT qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = ? LIMIT 1", [$date])->getRowArray();
        return $row['qty'] ?? null;
    }
}
