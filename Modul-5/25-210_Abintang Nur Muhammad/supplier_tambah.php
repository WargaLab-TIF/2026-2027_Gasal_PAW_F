<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: supplier.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Master Supplier Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Tambah Data Master Supplier Baru</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" placeholder="telp" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" placeholder="alamat" rows="4" required></textarea>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="supplier.php" class="btn btn-danger">Batal</a>
    </form>

</body>
</html>