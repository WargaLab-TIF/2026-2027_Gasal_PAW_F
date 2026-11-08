
<?php
include 'koneksi.php';

$query = "SELECT t.*, p.nama AS nama_pelanggan
          FROM transaksi t
          LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
          ORDER BY t.id DESC";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Data Transaksi Penjualan</h2>
    <p>Daftar transaksi pelanggan</p>

    <div class="menu">
        <a href="barang.php" class="btn btn-green">Data Barang</a>
    </div>

    <div class="section">

        <div class="section-title">Daftar Seluruh Transaksi</div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($result) > 0): ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>
                            <td>#<?= $row['id']; ?></td>

                            <td>
                                <?= htmlspecialchars($row['waktu_transaksi']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['nama_pelanggan'] ?? '-'); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['keterangan'] ?? '-'); ?>
                            </td>

                            <td class="text-bold">
                                Rp <?= number_format($row['total'], 0, ',', '.'); ?>
                            </td>

                            <td>
                                <a href="master_detail.php?transaksi_id=<?= $row['id']; ?>"
                                   class="btn">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data transaksi.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
