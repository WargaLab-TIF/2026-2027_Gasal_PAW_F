<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Master Supplier</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h3 style="color:#337ab7">Data Master Supplier
    <a href="supplier_tambah.php" class="btn btn-success btn-sm pull-right">Tambah Data</a>
  </h3>
  <hr>
  <table class="table table-bordered">
    <thead>
      <tr class="info"><th>No</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Tindakan</th></tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    $q = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id");
    while ($r = mysqli_fetch_assoc($q)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($r['nama']) ?></td>
        <td><?= htmlspecialchars($r['telp']) ?></td>
        <td><?= htmlspecialchars($r['alamat']) ?></td>
        <td>
          <a href="supplier_edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-xs">Edit</a>
          <a href="supplier_hapus.php?id=<?= $r['id'] ?>" class="btn btn-danger btn-xs"
             onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>