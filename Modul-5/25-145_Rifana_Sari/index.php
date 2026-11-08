
<?php
include 'config.php';

$query = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Data Master Supplier</h2>

    <div class="tambah">
        <a href="tambah.php">Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $no = 1;

        while ($supplier = mysqli_fetch_assoc($query)) {
        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($supplier['nama']); ?></td>
            <td><?php echo htmlspecialchars($supplier['telp']); ?></td>
            <td><?php echo htmlspecialchars($supplier['alamat']); ?></td>

            <td>
                <a class="edit" href="edit.php?id=<?php echo $supplier['id']; ?>">Edit</a>

                <a class="hapus"
                   href="hapus.php?id=<?php echo $supplier['id']; ?>"
                   onclick="return confirm('Anda yakin akan menghapus supplier ini?')">
                   Hapus
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
