
<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    JOIN pelanggan
    ON transaksi.id_pelanggan = pelanggan.id_pelanggan
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
</head>
<body>
<h2>data barang: </h2>
<a href="barang.php" class="tambah">Data Barang</a>

<h2>Data Transaksi Penjualan</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id_transaksi']; ?></td>
        <td><?= $data['waktu_transaksi']; ?></td>
        <td><?= $data['nama_pelanggan']; ?></td>
        <td><?= $data['keterangan']; ?></td>
        <td><?= $data['total']; ?></td>
        <td>
            <a href="detail_transaksi.php?id=<?= $data['id_transaksi']; ?>">
                Detail
            </a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
