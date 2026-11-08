
<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT * FROM barang
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>

<h2>Data Barang</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Barang</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id_barang']; ?></td>
        <td><?= $data['kode_barang']; ?></td>
        <td><?= $data['nama_barang']; ?></td>
        <td><?= $data['harga']; ?></td>
        <td><?= $data['stok']; ?></td>
        <td>
            <a href="hapus.php?id=<?= $data['id_barang']; ?>"
               onclick="return confirm('Yakin ingin menghapus barang ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
