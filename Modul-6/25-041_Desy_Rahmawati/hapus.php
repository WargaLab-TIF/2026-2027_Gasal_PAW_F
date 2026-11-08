
<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: barang.php");
    exit();
}

// Memeriksa penggunaan barang pada transaksi_detail
$cek = mysqli_query($koneksi, "
    SELECT COUNT(*) AS jumlah
    FROM transaksi_detail
    WHERE barang_id = $id
");

if (!$cek) {
    header("Location: barang.php?status=gagal_error");
    exit();
}

$data = mysqli_fetch_assoc($cek);

// Barang tidak boleh dihapus jika sudah digunakan
if ($data['jumlah'] > 0) {
    header("Location: barang.php?status=gagal_terpakai");
    exit();
}

// Menghapus barang jika belum digunakan
$hapus = mysqli_query($koneksi, "
    DELETE FROM barang
    WHERE id = $id
");

if ($hapus && mysqli_affected_rows($koneksi) > 0) {
    header("Location: barang.php?status=sukses_hapus");
} else {
    header("Location: barang.php?status=gagal_error");
}

exit();
?>
