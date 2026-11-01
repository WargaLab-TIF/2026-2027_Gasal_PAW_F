<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <style>
        /* CSS Murni Tanpa Bootstrap */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
        }
        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .card-header {
            background-color: #2e7d32;
            color: white;
            padding: 15px 20px;
        }
        .card-header h4 {
            margin: 0;
            font-size: 18px;
        }
        .card-body {
            padding: 20px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #2e7d32;
            outline: none;
        }
        textarea.form-control {
            resize: vertical;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            color: white;
            text-align: center;
        }
        .btn-success {
            background-color: #2e7d32;
        }
        .btn-success:hover {
            background-color: #1b5e20;
        }
        .btn-danger {
            background-color: #d9534f;
        }
        .btn-danger:hover {
            background-color: #c9302c;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data Master Supplier Baru</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp">Telp</label>
                        <input type="text" class="form-control" id="telp" name="telp" placeholder="Nomor telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat supplier" required></textarea>
                    </div>
                    <div class="button-group">
                        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        <a href="supplier.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama   = $_POST['nama'];
                    $telp   = $_POST['telp'];
                    $alamat = $_POST['alamat'];

                    $query = mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");

                    if ($query) {
                        echo "<script>alert('Data supplier berhasil ditambahkan!'); window.location='supplier.php';</script>";
                    } else {
                        echo "<div class='alert-danger'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>