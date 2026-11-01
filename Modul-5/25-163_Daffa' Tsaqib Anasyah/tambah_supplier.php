<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
    $sql   = mysqli_query($koneksi, $query);

    if ($sql) {
        header("location: supplier.php");
    } else {
        echo "<script>alert('Gagal menambah data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Master Supplier Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 40px;
            color: #333;
        }
        h2.title {
            color: #2980b9;
            font-weight: normal;
            margin-bottom: 20px;
        }
        table {
            width: 50%;
        }
        td {
            padding: 8px;
            vertical-align: middle;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-simpan {
            background-color: #2ecc71;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-simpan:hover {
            background-color: #27ae60;
        }
        .btn-batal {
            background-color: #e74c3c;
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            margin-left: 10px;
            display: inline-block;
        }
        .btn-batal:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h2 class="title">Tambah Data Master Supplier Baru</h2>

    <form method="POST" action="">
        <table>
            <tr>
                <td style="width: 15%;">Nama</td>
                <td style="width: 85%;"><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" rows="3" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="simpan" class="btn-simpan">Simpan</button>
                    <!-- Tombol Batal kembali ke halaman sebelumnya menggunakan JavaScript history.back() -->
                    <a href="javascript:history.back()" class="btn-batal">Batal</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>