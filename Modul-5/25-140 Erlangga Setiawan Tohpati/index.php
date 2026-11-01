<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; color: #333; }
        h2 { color: #2980b9; }
        .btn { padding: 6px 12px; text-decoration: none; color: white; border-radius: 4px; font-size: 14px; border: none; cursor: pointer; }
        .btn-success { background-color: #689f38; }
        .btn-warning { background-color: #f39c12; }
        .btn-danger { background-color: #c0392b; }
        .btn-container { margin-bottom: 15px; text-align: right; width: 800px; }
        table { border-collapse: collapse; width: 800px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #ebf5fb; color: #2c3e50; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

    <h2>Data Master Supplier</h2>

    <div class="btn-container">
        <a href="edit.php" class="btn btn-success">Tambah Data</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama</th>
                <th style="width: 20%;">Telp</th>
                <th style="width: 25%;">Alamat</th>
                <th style="width: 20%;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['telp']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <!-- Konfirmasi Hapus menggunakan JavaScript Confirm -->
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin akan menghapus supplier ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>