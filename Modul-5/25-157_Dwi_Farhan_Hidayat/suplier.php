<?php 
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn-tambah { background: #5cb85c; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; }
        .btn-edit { background: #f0ad4e; color: white; padding: 4px 8px; text-decoration: none; border-radius: 3px; }
        .btn-hapus { background: #d9534f; color: white; padding: 4px 8px; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>Data Master Supplier</h2>
    <a href="tambah_suplier.php" class="btn-tambah">Tambah Data</a>

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
        $query = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit_suplier.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                <a href="hapus_suplier.php?id=<?php echo $row['id']; ?>" class="btn-hapus" onclick="return confirm('Kamu yakin akan menghapus suplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>