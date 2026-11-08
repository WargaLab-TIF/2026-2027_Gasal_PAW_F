<?php
include 'koneksi.php';

if (isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id_barang = $_GET['id'];
    $cek_pakai = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = '$id_barang'");
    
    if (mysqli_num_rows($cek_pakai) > 0) {
        echo "<script>alert('Barang masih digunakan pada transaksi, tidak dapat dihapus!'); window.location='barang.php';</script>";
    } else {
        mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id_barang'");
        echo "<script>alert('Barang berhasil dihapus.'); window.location='barang.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f8fafc; color: #1e293b; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav { margin-bottom: 20px; display: flex; gap: 10px; }
        .nav a { text-decoration: none; padding: 8px 16px; background: #e0e7ff; color: #4f46e5; border-radius: 6px; font-weight: 600; font-size: 14px; }
        .nav a.active { background: #4f46e5; color: #fff; }
        h2 { border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f1f5f9; font-weight: 600; }
        .btn-danger { background: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .btn-danger:hover { background: #dc2626; }
    </style>
</head>
<body>
<div class="container">
    <div class="nav">
        <a href="transaksi.php">Data Transaksi</a>
        <a href="barang.php" class="active">Data Barang</a>
    </div>
    <h2>Daftar Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['kode_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td>
                    <a href="barang.php?action=hapus&id=<?= $row['id']; ?>" class="btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>