<?php
include 'koneksi.php';

if (isset($_POST['simpan_detail'])) {
    $transaksi_id = intval($_POST['transaksi_id']);
    $barang_id = intval($_POST['barang_id']);
    $qty = intval($_POST['qty']);
    $q_brg = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = '$barang_id'");
    $d_brg = mysqli_fetch_assoc($q_brg);
    $harga = $d_brg['harga'];
    $insert = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')");

    if ($insert) {
        $q_sum = mysqli_query($koneksi, "SELECT SUM(harga * qty) as grand_total FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
        $d_sum = mysqli_fetch_assoc($q_sum);
        $grand_total = $d_sum['grand_total'] ? $d_sum['grand_total'] : 0;
        mysqli_query($koneksi, "UPDATE transaksi SET total = '$grand_total' WHERE id = '$transaksi_id'");

        echo "<script>alert('Detail berhasil ditambahkan!'); window.location='tambahTransaksi.php?id=$transaksi_id';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data.'); window.location='tambahTransaksi.php?id=$transaksi_id';</script>";
    }
}
?>