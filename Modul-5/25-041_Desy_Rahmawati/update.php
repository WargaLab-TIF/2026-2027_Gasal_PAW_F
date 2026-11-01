
<?php
require_once 'koneksi.php';

$idSupplier = $_GET['id'];

$sqlData = "SELECT * FROM supplier WHERE id = '$idSupplier'";
$hasilData = mysqli_query($koneksi, $sqlData);
$supplier = mysqli_fetch_assoc($hasilData);

if (isset($_POST['update'])) {

    $namaSupplier = $_POST['nama'];
    $nomorTelepon = $_POST['telp'];
    $alamatSupplier = $_POST['alamat'];

    $sqlUpdate = "UPDATE supplier SET
                  nama = '$namaSupplier',
                  telp = '$nomorTelepon',
                  alamat = '$alamatSupplier'
                  WHERE id = '$idSupplier'";

    $prosesUpdate = mysqli_query($koneksi, $sqlUpdate);

    if ($prosesUpdate) {
        echo "<script>
                alert('Data supplier berhasil diperbarui!');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Supplier</title>

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
            background: #fff;
            padding: 25px;
        }

        h2 {
            color: #337ab7;
            font-size: 23px;
            font-weight: normal;
            margin-top: 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 25px;
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
            font-size: 14px;
        }

        .tombol {
            margin-left: 110px;
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
                flex-direction: column;
                align-items: flex-start;
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

    <h2>Form Edit Data Supplier</h2>

    <form method="POST" action="">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama"
                   value="<?= htmlspecialchars($supplier['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label for="telp">Telepon</label>
            <input type="text" id="telp" name="telp"
                   value="<?= htmlspecialchars($supplier['telp']); ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat"
                   value="<?= htmlspecialchars($supplier['alamat']); ?>" required>
        </div>

        <div class="tombol">
            <button type="submit" name="update">Update</button>
            <a href="index.php" class="batal">Batal</a>
        </div>

    </form>

</div>

</body>
</html>