<?php
include 'connec.php';
$result = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Supplier</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=add" />
</head>

<body>
    <h2>Data Supplier</h2>
    <div class="container">
        <a href="tambah.php" class="btn btn-tambah"><i class="material-symbols-outlined">add</i>Tambah Data</a>
    </div>
    <table id="container-tabel">
        <thead>
            <tr class="tr-idx">
                <th class="color-th1">No</th>
                <th class="color-th1">NAMA</th>
                <th class="color-th1">TELEPON</th>
                <th class="color-th1">ALAMAT</th>
                <th class="color-th1">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr class="tr-idx">
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['telp']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delet.php?id=<?= $row['id']; ?>" class="btn btn-hapus"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>