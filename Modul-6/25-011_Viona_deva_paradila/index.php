<?php
require_once("connect.php");

$require = mysqli_query($conn, "SELECT * FROM `transaksi`");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Transaksi</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Material Symbols -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=add" />
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light py-5">

    <div class="container">
        <!-- Header & Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 fw-bold text-dark m-0">MENU TRANSAKSI</h1>
            <div class="">
                <a href="tambah.php" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
                    <span class="material-symbols-outlined" style="font-size: 20px;">add</span> Tambah Data
                </a>
                <a href="hapus.php" class="btn btn-danger d-inline-flex align-items-center gap-1 shadow-sm">Hapus
                    Barang</a>
            </div>

        </div>


        <!-- Tabel Data Transaksi -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0" id="container-tabel">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>WAKTU TRANSAKSI</th>
                                <th>KETERANGAN</th>
                                <th>TOTAL</th>
                                <th>ID PELANGGAN</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $has_data = false;
                            while ($row = mysqli_fetch_assoc($require)) {
                                $has_data = true;
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($row['pelanggan_id']) ?></td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-2">
                                            <a href="edit.php?id=<?= $row['id']; ?>"
                                                class="btn btn-sm btn-warning text-dark fw-semibold px-3">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            if (!$has_data) {
                                echo '<tr><td colspan="6" class="text-center text-muted py-4">Belum ada data transaksi.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>