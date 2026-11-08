<?php
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // nambah detail
    $id_transaksi = $_POST['transaksi_id'];
    $barang_id = $_POST['barang'];
    $queryBarang = mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id");
    $barang = mysqli_fetch_assoc($queryBarang);
    $qty = $_POST['qty'];
    $harga = $barang['harga'] * $qty;
    $deskripsi = $_POST['keterangan'];

    mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty ) VALUES ('$id_transaksi', '$barang_id', '$harga','$qty')");
    mysqli_query($conn, "UPDATE transaksi SET total=(SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = $id_transaksi), keterangan = '$deskripsi' WHERE id = $id_transaksi");
} else {
    $id_transaksi = $_GET['id'] ?? 1; // Fallback jika $_GET['id'] tidak ada
}

$data = mysqli_query($conn, "SELECT *, transaksi_detail.harga AS total_harga FROM transaksi JOIN transaksi_detail ON transaksi_detail.transaksi_id = transaksi.id JOIN barang ON barang.id = transaksi_detail.barang_id WHERE transaksi.id = $id_transaksi ");
$total = mysqli_query($conn, "SELECT total, keterangan FROM transaksi WHERE id = '$id_transaksi'");
$totalData = mysqli_fetch_assoc($total);

$query = mysqli_query($conn, "SELECT b.*
FROM barang b
WHERE b.id NOT IN (
    SELECT td.barang_id
    FROM transaksi_detail td
    WHERE td.transaksi_id = $id_transaksi
);");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Card Utama -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h2 class="h4 mb-4 text-primary fw-bold">Detail Transaksi</h2>

                        <!-- Tabel Data Transaksi -->
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>NAMA BARANG</th>
                                        <th class="text-center">QUANTITY</th>
                                        <th class="text-end">HARGA BARANG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $has_items = false;
                                    while ($row = mysqli_fetch_assoc($data)) {
                                        $has_items = true;
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($row['qty']) ?></td>
                                        <td class="text-end">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php
                                    }
                                    if (!$has_items) {
                                        echo '<tr><td colspan="3" class="text-center text-muted py-3">Belum ada barang dalam transaksi ini.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="table-group-divider">
                                    <tr class="fw-bold">
                                        <td>TOTAL</td>
                                        <td colspan="2" class="text-end text-success fs-5">Rp <?= number_format($totalData['total'] ?? 0, 0, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Form Tambah Barang -->
                        <form action="" method="POST">
                            <input type="hidden" name="transaksi_id" value="<?= htmlspecialchars($id_transaksi) ?>">

                            <div class="mb-3">
                                <label for="barang" class="form-label fw-semibold">NAMA BARANG</label>
                                <select name="barang" id="barang" class="form-select" required>
                                    <option value="" disabled selected>Pilih Barang</option>
                                    <?php
                                    while ($rowBarang = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?= $rowBarang['id'] ?>"><?= htmlspecialchars($rowBarang['nama_barang']) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label fw-semibold">QUANTITY</label>
                                <input type="number" name="qty" id="qty" class="form-control" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-semibold">KETERANGAN</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?= htmlspecialchars($totalData['keterangan'] ?? "") ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary px-4" onclick="ghome()">Kembali</button>
                                <div>
                                    <button type="submit" class="btn btn-primary px-4 me-2">Tambah</button>
                                    <button type="button" class="btn btn-success px-4" onclick="ghome()">Selesai / Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function ghome() {
            window.location.href = "./index.php";
        }
    </script>
</body>
</html>