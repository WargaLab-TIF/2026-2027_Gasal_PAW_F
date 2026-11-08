<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: barang.php');
    exit;
}
$id = (int)($_POST['id'] ?? 0);
$cekBarang = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id = $id");
$barang    = mysqli_fetch_assoc($cekBarang);
if (!$barang) {
    $pesan = 'Data barang tidak ditemukan.';
} else {
    $cekPakai = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM transaksi_detail WHERE barang_id = $id");
    $jml      = (int)mysqli_fetch_assoc($cekPakai)['jml'];

    if ($jml > 0) {
        $pesan = 'Barang "' . $barang['nama_barang'] . '" tidak dapat dihapus karena masih digunakan pada '
               . $jml . ' transaksi.';
    } else {
        if (mysqli_query($conn, "DELETE FROM barang WHERE id = $id")) {
            $pesan = 'Barang "' . $barang['nama_barang'] . '" berhasil dihapus.';
        } else {
            $pesan = 'Gagal menghapus barang: ' . mysqli_error($conn);
        }
    }
}
header('Location: barang.php?pesan=' . urlencode($pesan));
exit;
?>
