<?php
$uri = service('uri')->getSegment(1);
$role = session()->get('role');
$toko = session()->get('toko');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= site_url('') ?>" class="brand-link text-center">
    <span class="brand-text font-weight-light"><?= esc($toko['nama'] ?? 'Kasir') ?></span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $uri === 'dashboard' || $uri === '' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('supplier') ?>" class="nav-link <?= $uri === 'supplier' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-truck"></i>
            <p>Supplier</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pelanggan') ?>" class="nav-link <?= $uri === 'pelanggan' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-address-book"></i>
            <p>Pelanggan</p>
          </a>
        </li>
        <li class="nav-item has-treeview <?= in_array($uri, ['produk', 'kategori_produk', 'satuan_produk']) ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= in_array($uri, ['produk', 'kategori_produk', 'satuan_produk']) ? 'active' : '' ?>">
            <i class="nav-icon fas fa-box"></i>
            <p>Produk</p>
            <i class="right fas fa-angle-right"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('kategori_produk') ?>" class="nav-link <?= $uri === 'kategori_produk' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('satuan_produk') ?>" class="nav-link <?= $uri === 'satuan_produk' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Satuan Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('produk') ?>" class="nav-link <?= $uri === 'produk' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Produk</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= in_array($uri, ['stok_masuk', 'stok_keluar']) ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= in_array($uri, ['stok_masuk', 'stok_keluar']) ? 'active' : '' ?>">
            <i class="fas fa-archive nav-icon"></i>
            <p>Stok</p>
            <i class="right fas fa-angle-right"></i>
          </a>
          <ul class="nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('stok_masuk') ?>" class="nav-link <?= $uri === 'stok_masuk' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Stok Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('stok_keluar') ?>" class="nav-link <?= $uri === 'stok_keluar' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Stok Keluar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('transaksi') ?>" class="nav-link <?= $uri === 'transaksi' ? 'active' : '' ?>">
            <i class="fas fa-money-bill nav-icon"></i>
            <p>Transaksi</p>
          </a>
        </li>
        <li class="nav-item has-treeview <?= in_array($uri, ['laporan_penjualan', 'laporan_stok_masuk', 'laporan_stok_keluar']) ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= in_array($uri, ['laporan_penjualan', 'laporan_stok_masuk', 'laporan_stok_keluar']) ? 'active' : '' ?>">
            <i class="fas fa-book nav-icon"></i>
            <p>Laporan</p>
            <i class="right fas fa-angle-right"></i>
          </a>
          <ul class="nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('laporan_penjualan') ?>" class="nav-link <?= $uri === 'laporan_penjualan' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Penjualan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan_stok_masuk') ?>" class="nav-link <?= $uri === 'laporan_stok_masuk' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Stok Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan_stok_keluar') ?>" class="nav-link <?= $uri === 'laporan_stok_keluar' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Stok Keluar</p>
              </a>
            </li>
          </ul>
        </li>
        <?php if ($role === 'admin'): ?>
          <li class="nav-item">
            <a href="<?= site_url('pengaturan') ?>" class="nav-link <?= $uri === 'pengaturan' ? 'active' : '' ?>">
              <i class="fas fa-cog nav-icon"></i>
              <p>Pengaturan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('pengguna') ?>" class="nav-link <?= $uri === 'pengguna' ? 'active' : '' ?>">
              <i class="fas fa-user nav-icon"></i>
              <p>Pengguna</p>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </nav>
  </div>
</aside>
