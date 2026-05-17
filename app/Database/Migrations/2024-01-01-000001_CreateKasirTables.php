<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKasirTables extends Migration
{
    public function up()
    {
        // kategori_produk
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kategori' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori_produk');

        // satuan_produk
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'satuan' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('satuan_produk');

        // supplier
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 255],
            'alamat' => ['type' => 'VARCHAR', 'constraint' => 100],
            'telepon' => ['type' => 'VARCHAR', 'constraint' => 15],
            'keterangan' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('supplier');

        // pelanggan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis_kelamin' => ['type' => 'ENUM', 'constraint' => ['Pria', 'Wanita', 'Lainya']],
            'alamat' => ['type' => 'TEXT'],
            'telepon' => ['type' => 'VARCHAR', 'constraint' => 15],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pelanggan');

        // pengguna
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 255],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'role' => ['type' => 'CHAR', 'constraint' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengguna');

        // produk
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'barcode' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_produk' => ['type' => 'VARCHAR', 'constraint' => 255],
            'kategori' => ['type' => 'INT', 'constraint' => 11],
            'satuan' => ['type' => 'INT', 'constraint' => 11],
            'harga' => ['type' => 'VARCHAR', 'constraint' => 10],
            'stok' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'terjual' => ['type' => 'VARCHAR', 'constraint' => 10, 'default' => '0'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produk');

        // toko
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 20],
            'alamat' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('toko');

        // stok_masuk
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tanggal' => ['type' => 'DATETIME'],
            'barcode' => ['type' => 'INT', 'constraint' => 11],
            'jumlah' => ['type' => 'VARCHAR', 'constraint' => 11],
            'keterangan' => ['type' => 'VARCHAR', 'constraint' => 50],
            'supplier' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('stok_masuk');

        // stok_keluar
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tanggal' => ['type' => 'DATETIME'],
            'barcode' => ['type' => 'INT', 'constraint' => 11],
            'jumlah' => ['type' => 'VARCHAR', 'constraint' => 10],
            'keterangan' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('stok_keluar');

        // transaksi
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tanggal' => ['type' => 'DATETIME'],
            'barcode' => ['type' => 'VARCHAR', 'constraint' => 10],
            'qty' => ['type' => 'VARCHAR', 'constraint' => 10],
            'total_bayar' => ['type' => 'VARCHAR', 'constraint' => 10],
            'jumlah_uang' => ['type' => 'VARCHAR', 'constraint' => 10],
            'diskon' => ['type' => 'VARCHAR', 'constraint' => 10],
            'pelanggan' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'nota' => ['type' => 'VARCHAR', 'constraint' => 15],
            'kasir' => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi', true);
        $this->forge->dropTable('stok_keluar', true);
        $this->forge->dropTable('stok_masuk', true);
        $this->forge->dropTable('toko', true);
        $this->forge->dropTable('produk', true);
        $this->forge->dropTable('pengguna', true);
        $this->forge->dropTable('pelanggan', true);
        $this->forge->dropTable('supplier', true);
        $this->forge->dropTable('satuan_produk', true);
        $this->forge->dropTable('kategori_produk', true);
    }
}
