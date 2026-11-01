<?php
include 'koneksi.php';
$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id = '$id'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: suplier.php");
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Master Supplier</title>
</head>
<body>
    <h3>Edit Data Master Supplier</h3>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $row['nama']; ?>" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" value="<?php echo $row['telp']; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required><?php echo $row['alamat']; ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="update">Update</button>
                    <a href="suplier.php">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>