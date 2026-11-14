<?php
include "koneksi.php";

$hasil_rentang = mysqli_query($koneksi, "SELECT MIN(waktu_transaksi) AS tanggal_awal,
    MAX(waktu_transaksi) AS tanggal_akhir FROM transaksi");
$data_rentang = mysqli_fetch_assoc($hasil_rentang);

if ($data_rentang["tanggal_awal"] != null) {
    $tanggal_awal_default = $data_rentang["tanggal_awal"];
    $tanggal_akhir_default = $data_rentang["tanggal_akhir"];
} else {
    $tanggal_awal_default = date("Y-m-d");
    $tanggal_akhir_default = date("Y-m-d");
}

$tanggal_mulai = isset($_GET["tanggal_mulai"]) ? $_GET["tanggal_mulai"] : $tanggal_awal_default;
$tanggal_selesai = isset($_GET["tanggal_selesai"]) ? $_GET["tanggal_selesai"] : $tanggal_akhir_default;

function tanggal_valid($tanggal) {
    $tanggal_objek = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $tanggal_objek && $tanggal_objek->format('Y-m-d') == $tanggal;
}

if (!tanggal_valid($tanggal_mulai) || !tanggal_valid($tanggal_selesai) || $tanggal_mulai > $tanggal_selesai) {
    header("Location: report.php");
    exit;
}

$tanggal_mulai = mysqli_real_escape_string($koneksi, $tanggal_mulai);
$tanggal_selesai = mysqli_real_escape_string($koneksi, $tanggal_selesai);

$sql_harian = "SELECT DATE(waktu_transaksi) AS tanggal_transaksi,
                      SUM(total) AS total_pendapatan
               FROM transaksi
               WHERE DATE(waktu_transaksi) BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'
               GROUP BY DATE(waktu_transaksi)
               ORDER BY DATE(waktu_transaksi) ASC";
$hasil_harian = mysqli_query($koneksi, $sql_harian);

$sql_ringkasan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
                         COALESCE(SUM(total), 0) AS total_pendapatan
                  FROM transaksi
                  WHERE DATE(waktu_transaksi) BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
$hasil_ringkasan = mysqli_query($koneksi, $sql_ringkasan);
$data_ringkasan = mysqli_fetch_assoc($hasil_ringkasan);

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

echo "\xEF\xBB\xBF";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <p>Periode: <?php echo date("d-m-Y", strtotime($tanggal_mulai)); ?> sampai
        <?php echo date("d-m-Y", strtotime($tanggal_selesai)); ?></p>

    <table border="1">
        <tr>
            <th>No.</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>
        <?php $no = 1; ?>
        <?php while ($data = mysqli_fetch_assoc($hasil_harian)) { ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data["total_pendapatan"]; ?></td>
                <td><?php echo date("d-m-Y", strtotime($data["tanggal_transaksi"])); ?></td>
            </tr>
            <?php $no++; ?>
        <?php } ?>
    </table>

    <br>
    <table border="1">
        <tr>
            <th>Jumlah Pelanggan Unik</th>
            <td><?php echo $data_ringkasan["jumlah_pelanggan"]; ?></td>
        </tr>
        <tr>
            <th>Total Pendapatan Keseluruhan</th>
            <td><?php echo $data_ringkasan["total_pendapatan"]; ?></td>
        </tr>
    </table>
</body>
</html>