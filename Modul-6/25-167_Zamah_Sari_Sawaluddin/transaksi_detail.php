<?php
include "koneksi.php";

if (!isset($_GET["transaksi_id"])) {
    header("Location: index.php?tabel=transaksi");
    exit;
}

$transaksi_id = (int) $_GET["transaksi_id"];

if ($transaksi_id <= 0) {
    header("Location: index.php?tabel=transaksi");
    exit;
}

// utk mengambil data transaksi dan nama pelanggan.
$hasil_transaksi = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    WHERE transaksi.id = $transaksi_id");

$data_transaksi = mysqli_fetch_assoc($hasil_transaksi);

if (!$data_transaksi) {
    die("Data transaksi tidak ditemukan.");
}

// untk mengambil semua barang yang sudah dimasukkan ke transaksi
$hasil_detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.kode_barang, barang.nama_barang
    FROM transaksi_detail
    INNER JOIN barang ON transaksi_detail.barang_id = barang.id
    WHERE transaksi_detail.transaksi_id = $transaksi_id
    ORDER BY barang.nama_barang");

$pesan = "";
if (isset($_GET["pesan"])) {
    if ($_GET["pesan"] == "tambah") {
        $pesan = "Detail transaksi berhasil ditambahkan dan total transaksi sudah diperbarui.";
    } else if ($_GET["pesan"] == "hapus") {
        $pesan = "Barang berhasil dihapus dari detail transaksi dan total sudah diperbarui.";
    } else if ($_GET["pesan"] == "gagal") {
        $pesan = "Detail transaksi gagal diproses.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form-page">
<div class="form-container">
    <div class="topline">
        <div>
            <h1>Detail Transaksi</h1>
            <p class="muted">Rincian barang dari transaksi yang dipilih.</p>
        </div>
        <a href="index.php?tabel=transaksi" class="btn btn-light">Kembali</a>
    </div>

    <?php if ($pesan != "") { ?>
        <div class="alert"><?php echo $pesan; ?></div>
    <?php } ?>

    <div class="panel">
        <h2>Informasi Transaksi</h2>
        <p><strong>ID Transaksi:</strong> <?php echo $data_transaksi["id"]; ?></p>
        <p><strong>Tanggal:</strong> <?php echo htmlspecialchars($data_transaksi["waktu_transaksi"] ?? "-"); ?></p>
        <p><strong>Pelanggan:</strong> <?php echo htmlspecialchars($data_transaksi["nama_pelanggan"] ?? "-"); ?></p>
        <p><strong>Keterangan:</strong> <?php echo htmlspecialchars($data_transaksi["keterangan"] ?? "-"); ?></p>
        <p><strong>Total:</strong> Rp <?php echo number_format((float) $data_transaksi["total"], 0, ",", "."); ?></p>
    </div>

    <div class="topline" style="margin-top: 25px;">
        <div>
            <h2>Barang yang Dibeli</h2>
            <p class="muted">Daftar barang yang sudah dimasukkan ke transaksi ini.</p>
        </div>
        <a href="tambah_detail.php?transaksi_id=<?php echo $transaksi_id; ?>" class="btn btn-blue">+ Tambah Detail</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($hasil_detail) > 0) { ?>
                    <?php while ($detail = mysqli_fetch_assoc($hasil_detail)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($detail["kode_barang"]); ?></td>
                            <td><?php echo htmlspecialchars($detail["nama_barang"]); ?></td>
                            <td>Rp <?php echo number_format((float) $detail["harga"], 0, ",", "."); ?></td>
                            <td><?php echo $detail["qty"]; ?></td>
                            <td>Rp <?php echo number_format((float) ($detail["harga"] * $detail["qty"]), 0, ",", "."); ?></td>
                            <td>
                                <form action="hapus.php" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus barang ini dari transaksi?');">
                                    <input type="hidden" name="tabel" value="transaksi_detail">
                                    <input type="hidden" name="transaksi_id" value="<?php echo $transaksi_id; ?>">
                                    <input type="hidden" name="barang_id" value="<?php echo $detail["barang_id"]; ?>">
                                    <button type="submit" class="btn btn-red">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="empty">Belum ada detail barang untuk transaksi ini.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>