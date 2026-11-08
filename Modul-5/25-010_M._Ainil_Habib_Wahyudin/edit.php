
<?php
require_once "koneksi.php";

$sql = "SELECT * FROM supplier WHERE id=" . $_GET['id'];
$result = mysqli_query($conn, $sql);

if ($result) {
    $field = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "UPDATE supplier SET
        nama = '" . $_POST['nama'] . "',
        telp = '" . $_POST['telp'] . "',
        alamat = '" . $_POST['alamat'] . "'
        WHERE id = " . $_GET['id'];

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
</head>
<body>

    <h3>Edit Data Supplier</h3>

    <form action="" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?php echo $field['nama']; ?>">
        <br><br>

        <label for="telp">Telp</label>
        <input type="text" name="telp" value="<?php echo $field['telp']; ?>">
        <br><br>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?php echo $field['alamat']; ?>">
        <br><br>

        <button type="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php';">Batal</button>
    </form>

</body>
</html>
