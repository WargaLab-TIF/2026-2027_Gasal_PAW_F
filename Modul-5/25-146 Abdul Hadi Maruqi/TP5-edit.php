<?php
require_once __DIR__ .'/TP5-koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
    header("Location: TP5-main.php");
}

$query = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
$row = mysqli_fetch_array($query);
?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Edit Data Master Supplier</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo $row['nama']; ?>" class="panjang">
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" value="<?php echo $row['telp']; ?>">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>">
        </div>
        <div class="form-tombol">
            <button type="submit" name="update" class="btn btn-hijau">Update</button>
            <a href="TP5-main.php" class="btn btn-merah">Batal</a>
        </div>
    </form>
</div>