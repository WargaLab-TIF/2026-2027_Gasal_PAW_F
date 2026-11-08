<?php
include 'koneksi.php';

// Update
if (isset($_POST['update'])) {
    $id     = $_POST['id'];
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $stmt = mysqli_prepare($conn, "UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $telp, $alamat, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

// Ambil data lama berdasarkan id
$id = (int) $_GET['id'];
$hasil = mysqli_query($conn, "SELECT * FROM supplier WHERE id = $id");
$row = mysqli_fetch_assoc($hasil);

if (!$row) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Data Supplier</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Edit Data Master Supplier</h2>

  <form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="baris">
      <label>Nama</label>
      <div class="kolom"><input class="input" type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" maxlength="100" required></div>
    </div>
    <div class="baris">
      <label>Telp</label>
      <div class="kolom"><input class="input" type="text" name="telp" value="<?= htmlspecialchars($row['telp']) ?>" maxlength="12" required></div>
    </div>
    <div class="baris">
      <label>Alamat</label>
      <div class="kolom"><input class="input" type="text" name="alamat" value="<?= htmlspecialchars($row['alamat']) ?>" required></div>
    </div>
    <div class="aksi">
      <button type="submit" name="update" class="btn btn-hijau">Update</button>
      <a class="btn btn-merah" href="index.php">Batal</a>
    </div>
  </form>
</div>
</body>
</html>
