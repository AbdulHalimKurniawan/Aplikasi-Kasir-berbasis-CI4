<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth (no filter)
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->match(['GET', 'POST'], 'login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');

// Protected routes
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // Kategori Produk
    $routes->get('kategori_produk', 'KategoriProduk::index');
    $routes->match(['GET', 'POST'], 'kategori_produk/read', 'KategoriProduk::read');
    $routes->post('kategori_produk/add', 'KategoriProduk::add');
    $routes->post('kategori_produk/delete', 'KategoriProduk::delete');
    $routes->post('kategori_produk/edit', 'KategoriProduk::edit');
    $routes->post('kategori_produk/get_kategori', 'KategoriProduk::getKategori');
    $routes->post('kategori_produk/search', 'KategoriProduk::search');

    // Satuan Produk
    $routes->get('satuan_produk', 'SatuanProduk::index');
    $routes->match(['GET', 'POST'], 'satuan_produk/read', 'SatuanProduk::read');
    $routes->post('satuan_produk/add', 'SatuanProduk::add');
    $routes->post('satuan_produk/delete', 'SatuanProduk::delete');
    $routes->post('satuan_produk/edit', 'SatuanProduk::edit');
    $routes->post('satuan_produk/get_satuan', 'SatuanProduk::getSatuan');
    $routes->post('satuan_produk/search', 'SatuanProduk::search');

    // Supplier
    $routes->get('supplier', 'Supplier::index');
    $routes->match(['GET', 'POST'], 'supplier/read', 'Supplier::read');
    $routes->post('supplier/add', 'Supplier::add');
    $routes->post('supplier/delete', 'Supplier::delete');
    $routes->post('supplier/edit', 'Supplier::edit');
    $routes->post('supplier/get_supplier', 'Supplier::getSupplier');
    $routes->post('supplier/search', 'Supplier::search');

    // Pelanggan
    $routes->get('pelanggan', 'Pelanggan::index');
    $routes->match(['GET', 'POST'], 'pelanggan/read', 'Pelanggan::read');
    $routes->post('pelanggan/add', 'Pelanggan::add');
    $routes->post('pelanggan/delete', 'Pelanggan::delete');
    $routes->post('pelanggan/edit', 'Pelanggan::edit');
    $routes->post('pelanggan/get_pelanggan', 'Pelanggan::getPelanggan');
    $routes->post('pelanggan/search', 'Pelanggan::search');

    // Produk
    $routes->get('produk', 'Produk::index');
    $routes->match(['GET', 'POST'], 'produk/read', 'Produk::read');
    $routes->post('produk/add', 'Produk::add');
    $routes->post('produk/delete', 'Produk::delete');
    $routes->post('produk/edit', 'Produk::edit');
    $routes->post('produk/get_produk', 'Produk::getProduk');
    $routes->post('produk/get_barcode', 'Produk::getBarcode');
    $routes->post('produk/get_nama', 'Produk::getNama');
    $routes->post('produk/get_stok', 'Produk::getStok');
    $routes->match(['GET', 'POST'], 'produk/produk_terlaris', 'Produk::produkTerlaris');
    $routes->match(['GET', 'POST'], 'produk/data_stok', 'Produk::dataStok');

    // Stok Masuk
    $routes->get('stok_masuk', 'StokMasuk::index');
    $routes->match(['GET', 'POST'], 'stok_masuk/read', 'StokMasuk::read');
    $routes->post('stok_masuk/add', 'StokMasuk::add');
    $routes->match(['GET', 'POST'], 'stok_masuk/laporan', 'StokMasuk::laporan');
    $routes->match(['GET', 'POST'], 'stok_masuk/stok_hari', 'StokMasuk::stokHari');

    // Stok Keluar
    $routes->get('stok_keluar', 'StokKeluar::index');
    $routes->match(['GET', 'POST'], 'stok_keluar/read', 'StokKeluar::read');
    $routes->post('stok_keluar/add', 'StokKeluar::add');

    // Transaksi
    $routes->get('transaksi', 'Transaksi::index');
    $routes->match(['GET', 'POST'], 'transaksi/read', 'Transaksi::read');
    $routes->post('transaksi/add', 'Transaksi::add');
    $routes->post('transaksi/delete', 'Transaksi::delete');
    $routes->get('transaksi/cetak/(:num)', 'Transaksi::cetak/$1');
    $routes->post('transaksi/penjualan_bulan', 'Transaksi::penjualanBulan');
    $routes->match(['GET', 'POST'], 'transaksi/transaksi_hari', 'Transaksi::transaksiHari');
    $routes->match(['GET', 'POST'], 'transaksi/transaksi_terakhir', 'Transaksi::transaksiTerakhir');

    // Laporan
    $routes->get('laporan_penjualan', 'LaporanPenjualan::index');
    $routes->get('laporan_stok_masuk', 'LaporanStokMasuk::index');
    $routes->get('laporan_stok_keluar', 'LaporanStokKeluar::index');

    // Pengguna
    $routes->get('pengguna', 'Pengguna::index');
    $routes->match(['GET', 'POST'], 'pengguna/read', 'Pengguna::read');
    $routes->post('pengguna/add', 'Pengguna::add');
    $routes->post('pengguna/delete', 'Pengguna::delete');
    $routes->post('pengguna/edit', 'Pengguna::edit');
    $routes->post('pengguna/get_pengguna', 'Pengguna::getPengguna');

    // Pengaturan
    $routes->get('pengaturan', 'Pengaturan::index');
    $routes->post('pengaturan/set_toko', 'Pengaturan::setToko');
});
