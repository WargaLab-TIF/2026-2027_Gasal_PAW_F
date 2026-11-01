<?php
include 'connec.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="tambah-body">
    <div id="container">
        <div id="container-tambah">
            <h2>Tambah Data Supplier</h2>

            <form action="" method="POST">
                <table id="tabel-tambah">
                    <tr>
                        <div class="form-group">
                            <td><label for="nama">Nama</label></td>
                            <td><input type="text" id="nama" name="nama" placeholder="Nama Supplier" required></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="telp">Telepon</label></td>
                            <td class="container-input"><input type="text" id="telp" name="telp"
                                    placeholder="08xxxxxxxxxxx" required></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="alamat">Alamat</label></td>
                            <td><textarea id="alamat" name="alamat" required></textarea></td>
                        </div>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-save">Save</button>
                            <a href="index.php" class="btn btn-cancel">Cancel</a>
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
</body>

</html>