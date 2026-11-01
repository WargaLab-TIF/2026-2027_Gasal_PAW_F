<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");

    if ($update) {
        header("location: supplier.php");
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Dataa Master Supplier</title>
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
        .btn-update {
            background-color: #f39c12;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-update:hover {
            background-color: #d68910;
        }
        .btn-batal {
            background-color: #e74c3c;
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            margin-left: 10px;
        }
        .btn-batal:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h2 class="title">Edit Data Master Supplier</h2>

    <form method="POST" action="">
        <table>
            <tr>
                <td style="width: 15%;">Nama</td>
                <td style="width: 85%;"><input type="text" name="nama" value="<?= $data['nama']; ?>" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" value="<?= $data['telp']; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" rows="3" required><?= $data['alamat']; ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="update" class="btn-update">Update</button>
                    <a href="index.php" class="btn-batal">Batal</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>