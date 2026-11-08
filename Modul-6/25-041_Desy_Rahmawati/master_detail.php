
<?php
include 'koneksi.php';

$transaksi = isset($_GET['transaksi_id'])
    ? (int) $_GET['transaksi_id'] : 0;

if ($transaksi <= 0) {
    header("Location: index.php");
    exit();
}

// Mengambil data master transaksi
$master = mysqli_query($koneksi, "
    SELECT t.*, p.nama AS nama_pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    WHERE t.id = $transaksi
");

$data_master = mysqli_fetch_assoc($master);

if (!$data_master) {
    header("Location: index.php");
    exit();
}

// Mengambil data detail transaksi
$detail = mysqli_query($koneksi, "
    SELECT td.*, b.kode_barang, b.nama_barang
    FROM transaksi_detail td
    JOIN barang b ON td.barang_id = b.id
    WHERE td.transaksi_id = $transaksi
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Detail Transaksi #<?= $transaksi; ?></h2>
    <p>Informasi master dan rincian barang transaksi</p>

    <div class="menu">
        <a href="index.php" class="btn btn-gray">Kembali</a>

        <a href="tambah_detail.php?transaksi_id=<?= $transaksi; ?>"
           class="btn btn-green">
            Tambah Barang
        </a>
    </div>

    <div class="section">

        <div class="section-title">Data Master Transaksi</div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total Transaksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>#<?= $data_master['id']; ?></td>

                        <td>
                            <?= htmlspecialchars($data_master['waktu_transaksi']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data_master['nama_pelanggan'] ?? '-'); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data_master['keterangan'] ?? '-'); ?>
                        </td>

                        <td class="text-bold">
                            Rp <?= number_format($data_master['total'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="section">

        <div class="section-title">Data Detail Transaksi</div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($detail) > 0): ?>

                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($detail)):
                            $subtotal = $row['harga'] * $row['qty'];
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>

                            <td><?= htmlspecialchars($row['kode_barang']); ?></td>

                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>

                            <td>
                                Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                            </td>

                            <td><?= $row['qty']; ?></td>

                            <td class="text-bold">
                                Rp <?= number_format($subtotal, 0, ',', '.'); ?>
                            </td>
                        </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada barang dalam transaksi.
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
