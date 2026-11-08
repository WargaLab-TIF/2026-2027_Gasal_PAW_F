<?php
include 'koneksi.php';
$r = mysqli_query($db, "SELECT t.*, p.nama FROM transaksi t JOIN pelanggan p ON p.id=t.pelanggan_id ORDER BY t.id");
?>
<h2>Data Transaksi</h2>
<p><a href="barang.php">Kelola Barang</a></p>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>Aksi</th></tr>
<?php while ($t = mysqli_fetch_assoc($r)): ?>
<tr>
  <td><?= $t['id'] ?></td>
  <td><?= $t['waktu_transaksi'] ?></td>
  <td><?= htmlspecialchars($t['nama']) ?></td>
  <td><?= htmlspecialchars($t['keterangan']) ?></td>
  <td align="right"><?= number_format($t['total'], 0, ',', '.') ?></td>
  <td><a href="detail.php?id=<?= $t['id'] ?>">Detail</a></td>
</tr>
<?php endwhile; ?>
</table>