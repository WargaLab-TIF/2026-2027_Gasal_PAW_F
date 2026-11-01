<?php
require "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "insert into supplier (nama, telp, alamat) values ('$nama', '$telp', '$alamat')");

    header("Location: main.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px 30px;
            background: #fff;
        }

        h2 {
            margin: 0 0 20px 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
            font-weight: 400;
            font-size: 28px;
            color: #337ab7;
        }

        .baris {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .baris label {
            width: 120px;
            text-align: right;
            padding-right: 20px;
            font-weight: bold;
        }

        .baris input {
            width: 300px;
            padding: 8px 10px;
            font-size: 13px;
            color: #555;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .baris input:focus {
            outline: none;
            border-color: #66afe9;
        }

        .tombol {
            margin-left: 140px;
        }

        .btn {
            display: inline-block;
            padding: 7px 14px;
            font-size: 13px;
            color: #fff;
            text-decoration: none;
            border: 1px solid transparent;
            border-radius: 3px;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-simpan { background: #5cb85c; border-color: #4cae4c; }
        .btn-batal  { background: #d9262c; border-color: #b81c21; }

        .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>

    <h2>Tambah Data Master Supplier Baru</h2>

    <form method="post">
        <div class="baris">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Nama">
        </div>

        <div class="baris">
            <label for="telp">Telp</label>
            <input type="text" id="telp" name="telp" placeholder="telp">
        </div>

        <div class="baris">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" placeholder="alamat">
        </div>

        <div class="tombol">
            <button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
            <a href="main.php" class="btn btn-batal">Batal</a>
        </div>
    </form>

</body>
</html>