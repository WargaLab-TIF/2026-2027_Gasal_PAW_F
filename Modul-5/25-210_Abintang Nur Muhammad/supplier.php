<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Data Master Supplier</h2>
    <div class="mb-3">
        <a href="supplier_tambah.php" class="btn btn-success">Tambah Data</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT * FROM supplier";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['telp']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td>
                    <a href="supplier_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="supplier_hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data supplier.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>