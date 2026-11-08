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
    $result = mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (now(), '',0,'PLG001')");
    $id_transaksi = mysqli_insert_id($conn);
}

$data = mysqli_query($conn, "SELECT *, transaksi_detail.harga AS total_harga FROM transaksi JOIN transaksi_detail ON transaksi_detail.transaksi_id = transaksi.id JOIN barang ON barang.id = transaksi_detail.barang_id WHERE transaksi.id = $id_transaksi ");
$total = mysqli_query($conn, "SELECT total FROM transaksi WHERE id = '$id_transaksi'");
$total = mysqli_fetch_assoc($total);
$query = mysqli_query($conn, "SELECT b.*
FROM barang b
WHERE b.id NOT IN (
    SELECT td.barang_id
    FROM transaksi_detail td
    WHERE td.transaksi_id = $id_transaksi
);");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 700px;">
        
        <!-- Tabel Detail Transaksi -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body p-4">
                <h2 class="h4 mb-3 fw-bold text-dark">Detail Transaksi</h2>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="container-tabel">
                        <thead>
                            <tr>
                                <th class="color-th1 bg-light">NAMA BARANG</th>
                                <th class="color-th1 bg-light">QUANTITY</th>
                                <th class="color-th1 bg-light">HARGA BARANG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                <tr>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td><?= $row['total_harga'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td class="transaksi fw-bold">TOTAL</td>
                                <td class="transaksi fw-bold" colspan="2"><?= $total['total'] ?? 0 ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Tambah Detail Transaksi -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="" method="POST">
                    <table class="table table-borderless align-middle mb-0" id="container-tabel">
                        <tr>
                            <td class="fw-semibold w-25">NAMA BARANG</td>
                            <td>
                                <select name="barang" id="barang" class="form-select">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['nama_barang'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">QUANTITY</td>
                            <td><input type="text" name="qty" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">KETERANGAN</td>
                            <td><textarea name="keterangan" class="form-control" rows="3"><?= $deskripsi ?? "" ?></textarea></td>
                        </tr>
                        <tr style="display: none;">
                            <td></td>
                            <td><input type="text" name="transaksi_id" hidden value="<?= $id_transaksi ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="pt-3">
                                <button type="submit" class="btn btn-primary px-4 me-2">Tambah</button>
                                <button type="button" class="btn btn-secondary px-4" onclick="ghome()">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
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