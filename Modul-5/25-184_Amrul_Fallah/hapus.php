<?php
include 'koneksi.php';

// Hapus data

try {
    $berhasil = mysqli_query($conn, "DELETE FROM supplier WHERE id = $id");
} catch (mysqli_sql_exception $e) {
    $berhasil = false;   // PHP 8.1+ melempar exception saat query gagal
}

if ($berhasil) {
    header("Location: index.php");
} else {
    echo "<script>alert('Supplier tidak bisa dihapus karena masih dipakai data barang.'); window.location='index.php';</script>";
}
