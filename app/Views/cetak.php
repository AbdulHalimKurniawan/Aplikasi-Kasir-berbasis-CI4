<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cetak</title>
</head>
<body>
  <div style="width:500px;margin:auto;">
    <br>
    <center>
      <?php $toko = session()->get('toko'); ?>
      <?= esc($toko['nama'] ?? '') ?><br>
      <?= esc($toko['alamat'] ?? '') ?><br><br>
      <table width="100%">
        <tr><td><?= esc($nota) ?></td><td align="right"><?= esc($tanggal) ?></td></tr>
      </table>
      <hr>
      <table width="100%">
        <tr><td width="50%"></td><td width="3%"></td><td width="10%" align="right"></td><td align="right" width="17%"><?= esc($kasir) ?></td></tr>
        <?php foreach ($produk as $item): ?>
          <tr><td><?= esc($item['nama_produk']) ?></td><td></td><td align="right"><?= $item['total'] ?></td><td align="right"><?= $item['harga'] ?></td></tr>
        <?php endforeach ?>
      </table>
      <hr>
      <table width="100%">
        <tr><td width="76%" align="right">Harga Jual</td><td width="23%" align="right"><?= $total ?></td></tr>
      </table>
      <hr>
      <table width="100%">
        <tr><td width="76%" align="right">Total</td><td width="23%" align="right"><?= $total ?></td></tr>
        <tr><td width="76%" align="right">Bayar</td><td width="23%" align="right"><?= $bayar ?></td></tr>
        <tr><td width="76%" align="right">Kembalian</td><td width="23%" align="right"><?= $kembalian ?></td></tr>
      </table>
      <br>
      Terima Kasih<br>
      <?= esc($toko['nama'] ?? '') ?>
    </center>
  </div>
  <script>window.print()</script>
</body>
</html>
