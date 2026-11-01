<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: supplier.php");
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM supplier WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$supplier = mysqli_fetch_assoc($result);

if (!$supplier) {
    header("Location: supplier.php");
    exit;
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update_query = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = '$id'";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: supplier.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Master Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Edit Data Master Supplier</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($supplier['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" value="<?= htmlspecialchars($supplier['telp']); ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" rows="4" required><?= htmlspecialchars($supplier['alamat']); ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="supplier.php" class="btn btn-danger">Batal</a>
    </form>

</body>
</html>