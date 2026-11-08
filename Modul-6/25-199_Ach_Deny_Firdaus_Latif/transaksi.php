<?php
include 'koneksi.php';

$transaksi_id = 1;
if (isset($_POST['tambah_detail'])) {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // Ambil harga satuan dari master barang
    $query_harga = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = '$barang_id'");
    $data_harga = mysqli_fetch_assoc($query_harga);
    $harga = $data_harga['harga'];

    $insert = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')");

    if ($insert) {
        $query_hitung = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total_akhir FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
        $data_hitung = mysqli_fetch_assoc($query_hitung);
        $total_akhir = $data_hitung['total_akhir'];

        mysqli_query($koneksi, "UPDATE transaksi SET total = '$total_akhir' WHERE id = '$transaksi_id'");

        echo "<script>alert('Item berhasil disimpan & total transaksi diperbarui!'); window.location='transaksi.php';</script>";
    }
}

$query_master = mysqli_query($koneksi, "SELECT t.*, p.nama AS nama_pelanggan FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.id WHERE t.id = '$transaksi_id'");
$master = mysqli_fetch_assoc($query_master);

$query_detail = mysqli_query($koneksi, "SELECT td.*, b.kode_barang, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.barang_id = b.id WHERE td.transaksi_id = '$transaksi_id'");

$barang_terpakai = array();
$query_cek = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
while($cek = mysqli_fetch_assoc($query_cek)) {
    $barang_terpakai[] = $cek['barang_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Master Detail Transaksi</title>
</head>
<body>
    <h2>[MASTER] DATA TRANSAKSI</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr><th>ID Transaksi</th><td><?php echo $master['id']; ?></td></tr>
        <tr><th>Waktu Transaksi</th><td><?php echo $master['waktu_transaksi']; ?></td></tr>
        <tr><th>Pelanggan</th><td><?php echo $master['nama_pelanggan']; ?></td></tr>
        <tr><th>Keterangan</th><td><?php echo $master['keterangan']; ?></td></tr>
        <tr><th>Total Belanja</th><td><strong>Rp <?php echo number_format($master['total'], 0, ',', '.'); ?></strong></td></tr>
    </table>

    <h2>[FORM INPUT DETAIL] TAMBAH BARANG</h2>
    <form method="POST" action="transaksi.php">
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <option value="">-- Silahkan Pilih Barang --</option>
            <?php
            $query_barang = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($b = mysqli_fetch_assoc($query_barang)) {

                $is_terpakai = in_array($b['id'], $barang_terpakai);
                $disabled    = $is_terpakai ? "disabled" : "";
                $info_teks   = $is_terpakai ? " (Sudah ada di rincian)" : "";

                echo "<option value='".$b['id']."' $disabled>[".$b['kode_barang']."] ".$b['nama_barang']." - Rp ".number_format($b['harga'])."$info_teks</option>";
            }
            ?>
        </select>

        <label>Jumlah (Qty):</label>
        <input type="number" name="qty" value="1" min="1" required style="width:50px;">

        <button type="submit" name="tambah_detail">Simpan Item</button>
    </form>

    <h2>[DETAIL] RINCIAN ITEM BELANJA</h2>
    <table border="1" cellpadding="8" cellspacing="0">
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
            <?php 
            $no = 1;
            while($d = mysqli_fetch_assoc($query_detail)) { 
                $subtotal = $d['harga'] * $d['qty'];
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['kode_barang']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td>Rp <?php echo number_format($d['harga']); ?></td>
                <td><?php echo $d['qty']; ?></td>
                <td>Rp <?php echo number_format($subtotal); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
