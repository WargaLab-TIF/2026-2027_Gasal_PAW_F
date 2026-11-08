<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "koneksi.php";

    $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES (
        '" . $_POST['nama'] . "',
        '" . $_POST['telp'] . "',
        '" . $_POST['alamat'] . "'
    )";

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
    <title>Tambah</title>
</head>
<body>
    <form action="" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama">
        <br><br>

        <label for="telp">Telp</label>
        <input type="text" name="telp">
        <br><br>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat">
        <br><br>

        <button type="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php';">Batal</button>
    </form>
</body>
</html>