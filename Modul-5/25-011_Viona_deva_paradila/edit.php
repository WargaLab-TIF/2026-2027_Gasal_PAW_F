<?php
include 'connec.php';

$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    mysqli_query($conn, "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = $id");
    header("Location: index.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM supplier WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="tambah-body">
    <div id="container">
        <div id="container-tambah">
            <h2>Edit Data Supplier</h2>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <table id="tabel-tambah">
                    <tr>
                        <div class="form-group">
                            <td><label for="nama">Nama</label></td>
                            <td><input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>"
                                    required></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="telp">Telepon</label></td>
                            <td class="container-input"><input type="text" id="telp" name="telp"
                                    value="<?= htmlspecialchars($data['telp']); ?>" required></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="alamat">Alamat</label></td>
                            <td><textarea id="alamat" name="alamat"
                                    required><?= htmlspecialchars($data['alamat']); ?></textarea></td>
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