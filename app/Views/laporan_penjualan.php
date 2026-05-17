<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Penjualan</title>
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <?= view('partials/head') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?= view('includes/nav') ?>
  <?= view('includes/aside') ?>
  <div class="content-wrapper">
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col"><h1 class="m-0 text-dark">Laporan Penjualan</h1></div></div></div></div>
    <section class="content">
      <div class="container-fluid"><div class="card"><div class="card-body">
        <table class="table w-100 table-bordered table-hover" id="laporan_penjualan">
          <thead><tr><th>No</th><th>Tanggal</th><th>Nama Produk</th><th>Total Bayar</th><th>Jumlah Uang</th><th>Diskon</th><th>Pelanggan</th><th>Action</th></tr></thead>
        </table>
      </div></div></div>
    </section>
  </div>
</div>
<?= view('includes/footer') ?>
<?= view('partials/footer') ?>
<script src="<?= base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
  var readUrl = '<?= site_url('transaksi/read') ?>';
  var deleteUrl = '<?= site_url('transaksi/delete') ?>';
</script>
<script src="<?= base_url('assets/js/unminify/laporan_penjualan.js?v=8') ?>"></script>
</body>
</html>
