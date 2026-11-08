<?php
require_once __DIR__ .'/TP5-koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    header("Location: TP5-main.php");
}
?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Tambah Data Master Supplier Baru</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama" class="panjang">
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" placeholder="telp">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" placeholder="alamat">
        </div>
        <div class="form-tombol">
            <button type="submit" name="simpan" class="btn btn-hijau">Simpan</button>
            <a href="TP5-main.php" class="btn btn-merah">Batal</a>
        </div>
    </form>
</div>