<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stok Keluar</title>
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
  <?= view('partials/head') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?= view('includes/nav') ?>
  <?= view('includes/aside') ?>
  <div class="content-wrapper">
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col"><h1 class="m-0 text-dark">Stok Keluar</h1></div></div></div></div>
    <section class="content">
      <div class="container-fluid"><div class="card">
        <div class="card-header"><button class="btn btn-success" data-toggle="modal" data-target="#modal">Add</button></div>
        <div class="card-body">
          <table class="table w-100 table-bordered table-hover" id="stok_keluar">
            <thead><tr><th>No</th><th>Tanggal</th><th>Barcode</th><th>Nama Produk</th><th>Jumlah</th><th>Keterangan</th></tr></thead>
          </table>
        </div>
      </div></div>
    </section>
  </div>
</div>
<div class="modal fade" id="modal"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title">Add Data</h5><button class="close" data-dismiss="modal"><span>&times;</span></button></div>
  <div class="modal-body">
    <form id="form">
      <div class="form-group"><label>Tanggal</label><input id="tanggal" type="text" class="form-control" name="tanggal" required></div>
      <div class="form-group"><label>Barcode</label><select name="barcode" id="barcode" class="form-control select2" required></select></div>
      <div class="form-group"><label>Jumlah</label><input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required></div>
      <div class="form-group"><label>Keterangan</label><select class="form-control" name="keterangan" required><option value="rusak">Rusak</option><option value="hilang">Hilang</option><option value="kadaluarsa">Kadaluarsa</option></select></div>
      <button class="btn btn-success" type="submit">Add</button>
      <button class="btn btn-danger" data-dismiss="modal">Close</button>
    </form>
  </div>
</div></div></div>
<?= view('includes/footer') ?>
<?= view('partials/footer') ?>
<script src="<?= base_url('assets/vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/adminlte/plugins/select2/js/select2.min.js') ?>"></script>
<script>
  var readUrl = '<?= site_url('stok_keluar/read') ?>';
  var addUrl = '<?= site_url('stok_keluar/add') ?>';
  var getBarcodeUrl = '<?= site_url('produk/get_barcode') ?>';
</script>
<script src="<?= base_url('assets/js/unminify/stok_keluar.js?v=8') ?>"></script>
</body>
</html>
