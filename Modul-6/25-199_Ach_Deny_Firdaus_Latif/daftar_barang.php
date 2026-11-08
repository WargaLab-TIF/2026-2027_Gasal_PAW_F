<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT b.*, s.nama AS nama_supplier FROM barang b LEFT JOIN supplier s ON b.supplier_id = s.id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Master Data Barang</title>
</head>
<body>
    <h2>DAFTAR BARANG MASTER </h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['kode_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td>Rp <?php echo number_format($row['harga']); ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['nama_supplier']; ?></td>
                <td>
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="transaksi.php">Buka Halaman Utama Transaksi Master-Detail</a>
</body>
</html>
