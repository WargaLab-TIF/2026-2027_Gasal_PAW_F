<?php
require_once __DIR__.'/TP6-koneksi.php';

$data = mysqli_query($conn,"SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.id");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Transaksi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Daftar Transaksi</h1>
  <p><a href="barang.php">Ke Data Barang</a></p>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Tanggal</th><th>Pelanggan</th>
      <th>Keterangan</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
    <?php while ($r = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?= e ($r['id']) ?></td>
      <td><?= e ($r['waktu_transaksi']) ?></td>
      <td><?= e ($r['pelanggan']) ?></td>
      <td><?= e ($r['keterangan']) ?></td>
      <td>Rp <?= number_format($r['total'], 0, ',', '.') ?></td>
      <td><a href="transaksi_detail.php?id=<?= $r['id'] ?>">Detail</a></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>