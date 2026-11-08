<?php
include 'koneksi.php';

// simpan
if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $stmt = mysqli_prepare($conn, "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama, $telp, $alamat);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tambah Data Supplier</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Tambah Data Master Supplier Baru</h2>

  <form method="post">
    <div class="baris">
      <label>Nama</label>
      <div class="kolom"><input class="input" type="text" name="nama" placeholder="Nama" maxlength="100" required></div>
    </div>
    <div class="baris">
      <label>Telp</label>
      <div class="kolom"><input class="input" type="text" name="telp" placeholder="telp" maxlength="12" required></div>
    </div>
    <div class="baris">
      <label>Alamat</label>
      <div class="kolom"><input class="input" type="text" name="alamat" placeholder="alamat" required></div>
    </div>
    <div class="aksi">
      <button type="submit" name="simpan" class="btn btn-hijau">Simpan</button>
      <a class="btn btn-merah" href="index.php">Batal</a>
    </div>
  </form>
</div>
</body>
</html>
