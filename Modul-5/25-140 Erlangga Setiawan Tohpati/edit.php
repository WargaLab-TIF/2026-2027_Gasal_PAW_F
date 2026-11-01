<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id            = $_POST['id'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp          = $_POST['telp'];
    $alamat        = $_POST['alamat'];

    $query = "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) 
              VALUES ('$id', '$nama', '$jenis_kelamin', '$telp', '$alamat')";
    
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data pelanggan berhasil ditambahkan!'); window.location='tambah_pelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
</head>
<body>
    <h2>Form Tambah Pelanggan</h2>
    <form action="" method="POST">
        <table>
            <tr>
                <td>ID Pelanggan</td>
                <td><input type="text" name="id" maxlength="20" required placeholder="Contoh: P001"></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td><input type="text" name="nama" maxlength="100" required></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <select name="jenis_kelamin" required>
                        <option value="L">Laki-laki (L)</option>
                        <option value="P">Perempuan (P)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telp" maxlength="12" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="simpan">Simpan Data</button></td>
            </tr>
        </table>
    </form>
</body>
</html>