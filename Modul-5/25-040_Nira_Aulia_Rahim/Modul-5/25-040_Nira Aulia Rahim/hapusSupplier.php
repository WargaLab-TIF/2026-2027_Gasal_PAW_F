<?php
include 'koneksi.php';

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id = '$id'");

if ($hapus) {
    echo "<script>alert('Data supplier berhasil dihapus!'); window.location='supplier.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='supplier.php';</script>";
}
?>