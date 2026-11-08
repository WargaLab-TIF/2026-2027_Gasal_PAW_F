<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT b.*, s.nama AS supplier
                              FROM barang b
                              JOIN supplier s ON s.id = b.supplier_id
                              ORDER BY b.id");
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Barang</title>
</head>
<body>
  <a href="transaksi.php">Data Transaksi</a>
  <h3>Data Barang</h3>
  <?php if ($pesan != ''): ?>
    <p><b><?= htmlspecialchars($pesan) ?></b></p>
  <?php endif; ?>
  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Supplier</th>
      <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($r = mysqli_fetch_assoc($query)): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($r['kode_barang']) ?></td>
      <td><?= htmlspecialchars($r['nama_barang']) ?></td>
      <td align="right"><?= number_format($r['harga'], 0, ',', '.') ?></td>
      <td align="right"><?= (int)$r['stok'] ?></td>
      <td><?= htmlspecialchars($r['supplier']) ?></td>
      <td>
        <form action="barang_hapus.php" method="post"
              onsubmit="return confirm('Yakin hapus barang ini?')">
          <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
          <input type="submit" value="Hapus">
        </form>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
