
<?php
require_once 'koneksi.php';

if (isset($_POST['simpan'])) {

    $namaSupplier = $_POST['nama'];
    $nomorTelepon = $_POST['telp'];
    $alamatSupplier = $_POST['alamat'];

    $sql = "INSERT INTO supplier (nama, telp, alamat)
            VALUES ('$namaSupplier', '$nomorTelepon', '$alamatSupplier')";

    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        echo "<script>
                alert('Data supplier berhasil ditambahkan!');
                window.location='index.php';
              </script>";
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Supplier</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            background: white;
            padding: 25px;
        }

        h2 {
            color: #337ab7;
            font-size: 23px;
            font-weight: normal;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-top: 0;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
        }

        label {
            width: 110px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            max-width: 400px;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .tombol {
            margin-left: 130px;
            margin-top: 10px;
        }

        button, .batal {
            display: inline-block;
            padding: 9px 16px;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background: #5cb85c;
        }

        .batal {
            background: #d9534f;
        }

        @media (max-width: 550px) {
            .form-group {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }

            label {
                width: auto;
            }

            input {
                max-width: 100%;
            }

            .tombol {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Form Tambah Supplier</h2>

    <form action="" method="POST">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama"
                   placeholder="Masukkan nama supplier" required>
        </div>

        <div class="form-group">
            <label for="telp">Telepon</label>
            <input type="text" id="telp" name="telp"
                   placeholder="Masukkan nomor telepon" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat"
                   placeholder="Masukkan alamat supplier" required>
        </div>

        <div class="tombol">
            <button type="submit" name="simpan">Simpan</button>
            <a href="index.php" class="batal">Batal</a>
        </div>

    </form>

</div>

</body>
</html>
