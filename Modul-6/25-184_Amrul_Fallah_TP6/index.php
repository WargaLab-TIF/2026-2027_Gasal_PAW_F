<?php
require 'koneksi.php';
$judul = 'Beranda';
$jml = [];
foreach (['barang', 'supplier', 'pelanggan', 'transaksi', 'transaksi_detail'] as $t) {
    $jml[$t] = $db->query("SELECT COUNT(*) FROM `$t`")->fetch_row()[0];
}
include 'header.php';
?>
<h1>Praktikum PAW - Modul 6: Master Detil</h1>
<div class="cards">
  <div class="card"><b><?= $jml['transaksi'] ?></b><span>Transaksi</span></div>
  <div class="card"><b><?= $jml['transaksi_detail'] ?></b><span>Detail transaksi</span></div>
  <div class="card"><b><?= $jml['barang'] ?></b><span>Barang</span></div>
  <div class="card"><b><?= $jml['pelanggan'] ?></b><span>Pelanggan</span></div>
  <div class="card"><b><?= $jml['supplier'] ?></b><span>Supplier</span></div>
</div>
<ul>
  <li><a href="transaksi.php">Halaman master-detil transaksi</a> (tugas 2 dan 4)</li>
  <li><a href="barang.php">Data barang + hapus dengan pengecekan relasi</a> (tugas 3)</li>
</ul>
<?php include 'footer.php'; ?>
