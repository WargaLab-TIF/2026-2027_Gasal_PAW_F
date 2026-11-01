<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Data Master Supplier Baru</h2>
    
    <form method="post">
        <table class="tabel-form">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" placeholder="Nama"></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" placeholder="telp"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" placeholder="alamat"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="simpan" class="btn btn-hijau">Simpan</button>
                    <a href="index.php" class="btn btn-merah">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>