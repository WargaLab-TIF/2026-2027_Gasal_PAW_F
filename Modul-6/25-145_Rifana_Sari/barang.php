
<?php
include 'koneksi.php';

$query = "
    SELECT barang.*, supplier.nama nama_supplier
    FROM barang
    LEFT JOIN supplier ON barang.supplier_id = supplier.id
    ORDER BY barang.id ASC
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Data Barang</h2>

    <div class="tambah">
        <a href="transaksi.php">Data Transaksi</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)):
        ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['kode_barang']) ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= htmlspecialchars($row['nama_supplier'] ?? '-') ?></td>
            <td>
                <a class="hapus"
                   href="hapus_barang.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin ingin menghapus barang ini?')">
                   Hapus
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>
