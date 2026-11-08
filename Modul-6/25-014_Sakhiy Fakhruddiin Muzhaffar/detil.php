<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID transaksi belum dipilih. <a href='transaksi.php'>Kembali</a>";
    exit;
}

$id_transaksi = $_GET['id'];

// Jika tombol SIMPAN diklik
if(isset($_POST['simpan'])){
    $id_barang = $_POST['barang_id'];
    $qty = $_POST['qty'];

    if ($id_barang == "" || $qty == "" || $qty <= 0) {
        echo "Barang dan qty harus diisi. Qty harus lebih dari 0.<br>";
    } else {

        // Cek apakah barang sudah ada di transaksi ini
        $cek_barang = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id = '$id_transaksi' AND barang_id = '$id_barang'");

        if(mysqli_num_rows($cek_barang) > 0){
            echo "Barang tersebut sudah ada di transaksi ini.<br>";
        } else {

            // Mencari harga barang
            $data_harga = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = '$id_barang'");
            $barang = mysqli_fetch_assoc($data_harga);
            $harga = $barang['harga'];

            // Menyimpan barang ke detail transaksi
            $simpan = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                       VALUES ('$id_transaksi', '$id_barang', '$harga', '$qty')";
            mysqli_query($koneksi, $simpan);

            // Menghitung ulang total transaksi
            $data_total = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total FROM transaksi_detail WHERE transaksi_id = '$id_transaksi'");
            $hasil_total = mysqli_fetch_assoc($data_total);
            $total = $hasil_total['total'];

            // Memperbarui total pada tabel transaksi
            mysqli_query($koneksi, "UPDATE transaksi SET total = '$total' WHERE id = '$id_transaksi'");

            echo "Barang berhasil ditambahkan.<br>";
        }
    }
}

// Mengambil data transaksi
$data_transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = '$id_transaksi'");
$transaksi = mysqli_fetch_assoc($data_transaksi);

if (!$transaksi) {
    echo "Transaksi tidak ditemukan. <a href='transaksi.php'>Kembali</a>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Data Transaksi Master</h2>

    ID Transaksi : <?php echo $transaksi['id']; ?><br>
    Tanggal : <?php echo $transaksi['waktu_transaksi']; ?><br>
    Keterangan : <?php echo $transaksi['keterangan']; ?><br>
    Total : Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?><br>

    <h3>Tambah Barang Baru</h3>

    <form method="post">
        Barang :
        <select name="barang_id" required>
            <option value="">-- Pilih Barang --</option>

            <?php
            // Menampilkan barang yang belum dimasukkan ke transaksi
            $query_barang = "SELECT * FROM barang
                             WHERE id NOT IN
                             (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$id_transaksi')";

            $hasil_barang = mysqli_query($koneksi, $query_barang);

            while($barang = mysqli_fetch_assoc($hasil_barang)){
                echo "<option value='" . $barang['id'] . "'>" . $barang['nama_barang'] . " - Rp " . number_format($barang['harga'], 0, ',', '.') . "</option>";
            }
            ?>
        </select>

        Qty : <input type="number" name="qty" min="1" required>

        <button type="submit" name="simpan">SIMPAN</button>
    </form>

    <h3>Daftar Barang di Transaksi Ini</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        <?php
        // Mengambil data barang yang sudah dimasukkan ke transaksi
        $query_detail = "SELECT transaksi_detail.*, barang.nama_barang
                         FROM transaksi_detail
                         JOIN barang ON transaksi_detail.barang_id = barang.id
                         WHERE transaksi_id = '$id_transaksi'";

        $hasil_detail = mysqli_query($koneksi, $query_detail);

        while($detail = mysqli_fetch_assoc($hasil_detail)){
            $subtotal = $detail['harga'] * $detail['qty'];

            echo "<tr>";
            echo "<td>" . $detail['nama_barang'] . "</td>";
            echo "<td>Rp " . number_format($detail['harga'], 0, ',', '.') . "</td>";
            echo "<td>" . $detail['qty'] . "</td>";
            echo "<td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>

    <a href="transaksi.php">Kembali ke Daftar Transaksi</a>
    &nbsp; | &nbsp;
    <a href="barang.php">Kelola Data Barang</a>

</body>
</html>