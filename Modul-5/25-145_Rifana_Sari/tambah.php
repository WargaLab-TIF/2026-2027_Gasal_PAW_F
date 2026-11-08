<?php
include 'config.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO supplier (nama, telp, alamat)
              VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param($stmt, "sss", $nama, $telp, $alamat);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan data supplier.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Tambah Data Master Supplier Baru</h2>

    <form method="POST">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama" required>
        </div>

        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" placeholder="Telp">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" placeholder="Alamat">
        </div>

        <div class="form-button">
            <button type="submit" name="simpan">Simpan</button>
            <a href="index.php">Batal</a>
        </div>

    </form>

</div>

</body>
</html>
