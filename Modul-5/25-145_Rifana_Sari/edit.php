
<?php
include 'config.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id = '$id'");
$supplier = mysqli_fetch_assoc($query);

if (!$supplier) {
    die("Data supplier tidak ditemukan.");
}

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE supplier
              SET nama = ?, telp = ?, alamat = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param($stmt, "sssi", $nama, $telp, $alamat, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data supplier.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Edit Data Master Supplier</h2>

    <form method="POST">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama"
                value="<?php echo htmlspecialchars($supplier['nama']); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp"
                value="<?php echo htmlspecialchars($supplier['telp']); ?>">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat"
                value="<?php echo htmlspecialchars($supplier['alamat']); ?>">
        </div>

        <div class="form-button">
            <button type="submit" name="update">Update</button>
            <a href="index.php">Batal</a>
        </div>

    </form>

</div>

</body>
</html>
