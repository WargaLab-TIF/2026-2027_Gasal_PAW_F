<?php
include "koneksi.php";

// 1. Validasi Keamanan: Wajib melalui master-transaksi.php dan membawa parameter ID
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'master-transaksi.php') === false || !isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Akses ditolak! Anda harus melalui halaman Master Transaksi.'); window.location='master-transaksi.php';</script>";
    exit;
}

$id_transaksi = $_GET['id'];
$id_aman = mysqli_real_escape_string($conn, $id_transaksi);

// 2. Ambil data informasi master transaksi & nama pelanggan
$query_header = "SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id WHERE transaksi.id = '$id_aman'";
$result_header = mysqli_query($conn, $query_header);
$data_transaksi = mysqli_fetch_assoc($result_header);

// Jika ID transaksi tidak valid atau tidak ada di database
if (!$data_transaksi) {
    echo "<script>alert('Data transaksi tidak ditemukan!'); window.location='master-transaksi.php';</script>";
    exit;
}

// 3. Ambil data rincian (detil) barang untuk transaksi ini
$query_detil = "SELECT transaksi_detail.*, barang.nama_barang, barang.harga FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_detail.transaksi_id = '$id_aman'";
$result_detil = mysqli_query($conn, $query_detil);

// Kumpulkan ID barang yang sudah dipilih untuk dropdown unik (disabled)
$barang_sudah_dipilih = [];
if ($result_detil) {
    while ($row_det = mysqli_fetch_assoc($result_detil)) {
        $barang_sudah_dipilih[] = $row_det['barang_id'];
    }
    mysqli_data_seek($result_detil, 0);
}

// 4. Ambil seluruh data barang untuk pilihan dropdown
$query_barang = "SELECT * FROM barang";
$result_barang = mysqli_query($conn, $query_barang);

// 5. Proses Tambah Item Detil & Hitung Otomatis Total Transaksi (Tugas Nomor 4)
if (isset($_POST['tambah_item'])) {
    $id_b = mysqli_real_escape_string($conn, $_POST['id_barang']);
    $qty  = (int) $_POST['qty'];

    // Ambil harga satuan barang
    $q_harga = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$id_b'");
    $d_harga = mysqli_fetch_assoc($q_harga);
    $harga_satuan = $d_harga['harga'] ?? 0;

    // A. Simpan ke tabel transaksi_detail
    $query_insert = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$id_aman', '$id_b', '$harga_satuan', '$qty')";
    mysqli_query($conn, $query_insert);

    // B. Hitung ulang total transaksi dengan SUM(harga * qty) dari seluruh detail milik transaksi yang sama
    $q_hitung = mysqli_query($conn, "SELECT SUM(harga * qty) AS total_baru FROM transaksi_detail WHERE transaksi_id = '$id_aman'");
    $d_hitung = mysqli_fetch_assoc($q_hitung);
    $total_baru = $d_hitung['total_baru'] ?? 0;

    // C. Update kolom total pada tabel transaksi utama
    mysqli_query($conn, "UPDATE transaksi SET total = '$total_baru' WHERE id = '$id_aman'");

    // Refresh halaman detail
    header("Location: detil-transaksi.php?id=" . $id_aman);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rincian Detil Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f6f9;
            margin: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        .panel-info {
            background-color: #e8f4fd;
            border-left: 5px solid #3498db;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 4px;
        }

        .panel-info p {
            margin: 5px 0;
        }

        .form-panel {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 6px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #219653;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #fafafa;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="master-transaksi.php" class="back-link">&larr; Kembali ke Daftar Master Transaksi</a>
    
    <h2>Form Rincian Detil Transaksi</h2>

    <!--  Informasi Ringkas Transaksi -->
    <div class="panel-info">
        <p><strong>ID Transaksi:</strong> #<?php echo $data_transaksi['id']; ?></p>
        <p><strong>Waktu:</strong> <?php echo $data_transaksi['waktu_transaksi']; ?></p>
        <p><strong>Pelanggan:</strong> <?php echo htmlspecialchars($data_transaksi['nama']); ?></p>
        <p><strong>Keterangan:</strong> <?php echo htmlspecialchars($data_transaksi['keterangan']); ?></p>
        <p style="font-size: 1.15em; margin-top: 10px;"><strong>Total Tagihan:</strong> <span style="color: #27ae60; font-weight: bold;">Rp <?php echo number_format($data_transaksi['total'], 0, ',', '.'); ?></span></p>
    </div>

    <!-- Form Tambah Item Detil-->
    <div class="form-panel">
        <h3 style="margin-top: 0; color: #2c3e50;">Tambah Rincian Barang</h3>
        <form method="POST">
            <label>Pilih Barang:</label>
            <select name="id_barang" required>
                <option value="">-- Pilih Barang dari Stok --</option>
                <?php while ($b = mysqli_fetch_assoc($result_barang)): ?>
                    <?php $sudah_dipilih = in_array($b['id'], $barang_sudah_dipilih); ?>
                    <option value="<?php echo $b['id']; ?>" <?php echo $sudah_dipilih ? 'disabled style="color: #999;"' : ''; ?>>
                        <?php echo $b['nama_barang']; ?> (Stok: <?php echo $b['stok']; ?> - Rp <?php echo number_format($b['harga'], 0, ',', '.'); ?>) <?php echo $sudah_dipilih ? '[Sudah Dipilih]' : ''; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Jumlah (Qty):</label>
            <input type="number" name="qty" value="1" min="1" required>

            <button type="submit" name="tambah_item" class="btn-submit">+ Tambahkan ke Transaksi</button>
        </form>
    </div>

    <!-- Tabel Rincian Barang -->
    <h3 style="color: #2c3e50;">Daftar Item Pembelian</h3>
    <?php if ($result_detil && mysqli_num_rows($result_detil) > 0): ?>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <?php while ($detil = mysqli_fetch_assoc($result_detil)): ?>
            <tr>
                <td><?php echo htmlspecialchars($detil['nama_barang']); ?></td>
                <td>Rp <?php echo number_format($detil['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $detil['qty']; ?></td>
                <td style="font-weight: bold; color: #2980b9;">Rp <?php echo number_format($detil['harga'] * $detil['qty'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="color: #e74c3c; font-style: italic;">Belum ada rincian barang pada transaksi ini.</p>
    <?php endif; ?>
</div>

</body>
</html>