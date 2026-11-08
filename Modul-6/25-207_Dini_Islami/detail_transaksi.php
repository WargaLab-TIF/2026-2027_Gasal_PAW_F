
<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    WHERE transaksi.id_transaksi = '$id'
");

$transaksi = mysqli_fetch_assoc($query);

if (!$transaksi) {
    die("Data transaksi tidak ditemukan!");
}

if (isset($_POST['tambah'])) {
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    $cek = mysqli_query($koneksi, "
        SELECT * FROM transaksi_detail
        WHERE id_transaksi = '$id'
        AND id_barang = '$id_barang'
    ");


    $barang = mysqli_query($koneksi, "
        SELECT * FROM barang
        WHERE id_barang = '$id_barang'
    ");

    $data_barang = mysqli_fetch_assoc($barang);

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang sudah dimasukkan!');</script>";
    } elseif ($qty < 1) {
        echo "<script>alert('Jumlah barang minimal 1!');</script>";
    } elseif ($qty > $data_barang['stok']) {
        echo "<script>alert('Stok barang tidak mencukupi!');</script>";
    } else {
        $harga = $data_barang['harga'];


$insert = mysqli_query($koneksi, "
    INSERT INTO transaksi_detail
    (id_transaksi, id_barang, harga, qty)
    VALUES ('$id', '$id_barang', '$harga', '$qty')
");

if ($insert) {


    $hitung = mysqli_query($koneksi, "
        SELECT SUM(harga * qty) AS total_baru
        FROM transaksi_detail
        WHERE id_transaksi = '$id'
    ");

    $data_total = mysqli_fetch_assoc($hitung);
    $total = $data_total['total_baru'];

    mysqli_query($koneksi, "
        UPDATE transaksi
        SET total = '$total'
        WHERE id_transaksi = '$id'
    ");

    header("Location: detail_transaksi.php?id=$id");
    exit;
}


        header("Location: detail_transaksi.php?id=$id");
        exit;
    }
}


$barang = mysqli_query($koneksi, "
    SELECT * FROM barang
    ORDER BY nama_barang
");


$detail = mysqli_query($koneksi, "
    SELECT transaksi_detail.*, barang.kode_barang, barang.nama_barang
    FROM transaksi_detail
    JOIN barang ON transaksi_detail.id_barang = barang.id_barang
    WHERE transaksi_detail.id_transaksi = '$id'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
</head>
<body>

<h2>Detail Transaksi</h2>

<p>ID Transaksi : <?= $transaksi['id_transaksi']; ?></p>
<p>Pelanggan : <?= $transaksi['nama_pelanggan']; ?></p>
<p>Tanggal : <?= $transaksi['waktu_transaksi']; ?></p>
<p>Keterangan : <?= $transaksi['keterangan']; ?></p>

<hr>

<h3>Tambah Barang</h3>

<form method="post">

    <label>Nama Barang</label>
    <select name="id_barang" required>
        <option value="">-- Pilih Barang --</option>

        <?php while ($b = mysqli_fetch_assoc($barang)) { 

            $cek_barang = mysqli_query($koneksi, "
                SELECT * FROM transaksi_detail
                WHERE id_transaksi = '$id'
                AND id_barang = '".$b['id_barang']."'
            ");

            $sudah_dipilih = mysqli_num_rows($cek_barang) > 0;
        ?>

        <option value="<?= $b['id_barang']; ?>"
            <?= $sudah_dipilih ? 'disabled' : ''; ?>>

            <?= $b['nama_barang']; ?>
            - Rp <?= number_format($b['harga']); ?>

            <?= $sudah_dipilih ? '(Sudah dipilih)' : ''; ?>

        </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Jumlah Barang</label>
    <input type="number" name="qty" min="1" required>

    <br><br>

    <button type="submit" name="tambah">Tambah Barang</button>

</form>

<hr>

<h3>Daftar Barang Transaksi</h3>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

    <?php
    $no = 1;
    while ($data = mysqli_fetch_assoc($detail)) {
    ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['kode_barang']; ?></td>
        <td><?= $data['nama_barang']; ?></td>
        <td>Rp <?= number_format($data['harga']); ?></td>
        <td><?= $data['qty']; ?></td>
        <td>Rp <?= number_format($data['harga'] * $data['qty']); ?></td>
    </tr>

    <?php } ?>

</table>

<br>

<a href="index.php">Kembali</a>

</body>
</html>
<?php
$total_query = mysqli_query($koneksi, "
    SELECT total FROM transaksi
    WHERE id_transaksi = '$id'
");

$total_data = mysqli_fetch_assoc($total_query);
?>

<h3>
    Total Transaksi:
    Rp <?= number_format($total_data['total'], 0, ',', '.'); ?>
</h3>
