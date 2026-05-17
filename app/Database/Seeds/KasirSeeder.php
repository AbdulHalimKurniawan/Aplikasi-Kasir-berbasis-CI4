<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KasirSeeder extends Seeder
{
    public function run()
    {
        // Toko
        $this->db->table('toko')->insert([
            'id' => 1, 'nama' => 'Toko Tum',
            'alamat' => 'Jln Raya Klesem Selatan No 1E Wanadadi, Banjarnegara, Indonesia',
        ]);

        // Pengguna (admin password: 22753090)
        $this->db->table('pengguna')->insertBatch([
            ['id' => 1, 'username' => 'admin', 'password' => password_hash('2511050055', PASSWORD_DEFAULT), 'nama' => 'Admin', 'role' => '1'],
            ['id' => 2, 'username' => 'kasir', 'password' => password_hash('kasir123', PASSWORD_DEFAULT), 'nama' => 'Kasir', 'role' => '2'],
        ]);

        // Kategori Produk
        $this->db->table('kategori_produk')->insertBatch([
            ['id' => 1, 'kategori' => 'Tekhnologi'],
            ['id' => 2, 'kategori' => 'Kebutuhan'],
        ]);

        // Satuan Produk
        $this->db->table('satuan_produk')->insertBatch([
            ['id' => 1, 'satuan' => 'Bungkus'],
            ['id' => 2, 'satuan' => 'Voucher'],
        ]);

        // Supplier
        $this->db->table('supplier')->insertBatch([
            ['id' => 1, 'nama' => 'Tulus', 'alamat' => 'Banjarnegara', 'telepon' => '083321128832', 'keterangan' => 'Aktif'],
            ['id' => 2, 'nama' => 'Nur', 'alamat' => 'Cilacap', 'telepon' => '082235542637', 'keterangan' => 'Baru'],
        ]);

        // Pelanggan
        $this->db->table('pelanggan')->insertBatch([
            ['id' => 1, 'nama' => 'Adam', 'jenis_kelamin' => 'Pria', 'alamat' => 'Seoul', 'telepon' => '081237483291'],
            ['id' => 2, 'nama' => 'Rahma', 'jenis_kelamin' => 'Wanita', 'alamat' => 'Banjarnegara', 'telepon' => '085463728374'],
        ]);

        // Produk
        $this->db->table('produk')->insertBatch([
            ['id' => 1, 'barcode' => 'PULS ALPRB', 'nama_produk' => 'Voucher Pulsa 50000', 'kategori' => 1, 'satuan' => 2, 'harga' => '55000', 'stok' => 10, 'terjual' => '0'],
            ['id' => 2, 'barcode' => 'DJRM SPER', 'nama_produk' => 'Djarum Super 12', 'kategori' => 2, 'satuan' => 1, 'harga' => '18000', 'stok' => 20, 'terjual' => '0'],
        ]);
    }
}
