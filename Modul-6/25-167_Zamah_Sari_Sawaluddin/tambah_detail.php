<?php
include "koneksi.php";

if (!isset($_GET["transaksi_id"])) {
    header("Location: index.php?tabel=transaksi");
    exit;
}

$transaksi_id = (int) $_GET["transaksi_id"];

$hasil_transaksi = mysqli_query($koneksi, "SELECT id FROM transaksi WHERE id = $transaksi_id");
if (mysqli_num_rows($hasil_transaksi) == 0) {
    die("Transaksi tidak ditemukan.");
}

$pesan_error = "";

if (isset($_POST["simpan"])) {
    $barang_id = (int) $_POST["barang_id"];
    $qty = (int) $_POST["qty"];

    if ($qty <= 0) {
        $pesan_error = "Jumlah barang harus lebih dari 0.";
    } else {
        $cek_barang = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail
            WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id");

        if (mysqli_num_rows($cek_barang) > 0) {
            $pesan_error = "Barang tersebut sudah ada dalam detail transaksi ini.";
        } else {
            $hasil_barang = mysqli_query($koneksi, "SELECT id, harga FROM barang WHERE id = $barang_id");
            $data_barang = mysqli_fetch_assoc($hasil_barang);

            if (!$data_barang) {
                $pesan_error = "Barang tidak ditemukan.";
            } else {
                $harga = (int) $data_barang["harga"];

                $sql_tambah = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                    VALUES ($transaksi_id, $barang_id, $harga, $qty)";

                if (mysqli_query($koneksi, $sql_tambah)) {

                    $hasil_total = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total
                        FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
                    $data_total = mysqli_fetch_assoc($hasil_total);
                    $total_baru = (int) $data_total["total"];

                    mysqli_query($koneksi, "UPDATE transaksi SET total = $total_baru WHERE id = $transaksi_id");

                    header("Location: transaksi_detail.php?transaksi_id=$transaksi_id&pesan=tambah");
                    exit;
                } else {
                    $pesan_error = "Detail transaksi gagal disimpan: " . mysqli_error($koneksi);
                }
            }
        }
    }
}

$hasil_barang = mysqli_query($koneksi, "SELECT id, kode_barang, nama_barang, harga, stok
    FROM barang
    WHERE id NOT IN (
        SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id
    )
    ORDER BY nama_barang");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form-page">
<div class="form-container">
    <div class="topline">
        <div>
            <h1>Tambah Detail Transaksi</h1>
            <p class="muted">Transaksi ID: <?php echo $transaksi_id; ?></p>
        </div>
    </div>

    <?php if ($pesan_error != "") { ?>
        <div class="alert error"><?php echo htmlspecialchars($pesan_error); ?></div>
    <?php } ?>

    <?php if (mysqli_num_rows($hasil_barang) > 0) { ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Barang</label>
                <select name="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php while ($barang = mysqli_fetch_assoc($hasil_barang)) { ?>
                        <option value="<?php echo $barang["id"]; ?>">
                            <?php echo htmlspecialchars($barang["kode_barang"] . " - " . $barang["nama_barang"]); ?>
                            (Rp <?php echo number_format($barang["harga"], 0, ",", "."); ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah Barang (Qty)</label>
                <input type="number" name="qty" min="1" value="1" required>
            </div>

            <div class="form-actions">
                <a href="transaksi_detail.php?transaksi_id=<?php echo $transaksi_id; ?>" class="btn btn-light">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-blue">Simpan Detail</button>
            </div>
        </form>
    <?php } else { ?>
        <div class="alert">Semua barang sudah dimasukkan ke transaksi ini. Tidak ada pilihan barang lain.</div>
        <div class="form-actions">
            <a href="transaksi_detail.php?transaksi_id=<?php echo $transaksi_id; ?>" class="btn btn-light">Kembali</a>
        </div>
    <?php } ?>
</div>
</body>
</html>