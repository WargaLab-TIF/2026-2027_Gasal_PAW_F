<?php
include 'koneksi.php';

// ngmbil semua data supplier dri database
$hasil = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Master Supplier</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <div class="atas">
    <h2>Data Master Supplier</h2>
    <a class="btn btn-hijau" href="tambah.php">Tambah Data</a>
  </div>

  <table class="data">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Telp</th>
      <th>Alamat</th>
      <th>Tindakan</th>
    </tr>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= htmlspecialchars($row['telp']) ?></td>
      <td><?= htmlspecialchars($row['alamat']) ?></td>
      <td>
        <a class="btn btn-oranye btn-sm" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="btn btn-merah btn-sm" href="hapus.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>
