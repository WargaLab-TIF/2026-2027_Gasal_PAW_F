
<?php
include 'koneksi.php';

$transaksi = isset($_GET['transaksi_id'])
    ? (int) $_GET['transaksi_id'] : 0;

if ($transaksi <= 0) {
    header("Location: index.php");
    exit();
}

// Memastikan transaksi tersedia
$cektransaksi = mysqli_query($koneksi, "
    SELECT id FROM transaksi
    WHERE id = $transaksi
");

if (!$cektransaksi || mysqli_num_rows($cektransaksi) == 0) {
    header("Location: index.php");
    exit();
}

$error = "";

// Proses menyimpan detail barang
if (isset($_POST['simpan'])) {

    $barang = isset($_POST['barang_id'])
        ? (int) $_POST['barang_id'] : 0;

    $qty = isset($_POST['qty'])
        ? (int) $_POST['qty'] : 0;

    if ($barang <= 0 || $qty < 1) {

        $error = "Pilih barang dan masukkan jumlah dengan benar.";

    } else {

        // Memeriksa apakah barang sudah ada dalam transaksi ini
        $cek = mysqli_query($koneksi, "
            SELECT COUNT(*) AS jumlah
            FROM transaksi_detail
            WHERE transaksi_id = $transaksi
            AND barang_id = $barang
        ");

        $data_cek = mysqli_fetch_assoc($cek);

        if ($data_cek['jumlah'] > 0) {

            $error = "Barang tersebut sudah ditambahkan pada transaksi ini.";

        } else {

            // Mengambil harga barang dari tabel barang
            $caribarang = mysqli_query($koneksi, "
                SELECT harga
                FROM barang
                WHERE id = $barang
            ");

            $data_barang = mysqli_fetch_assoc($caribarang);

            if (!$data_barang) {

                $error = "Barang tidak ditemukan.";

            } else {

                $harga = (int) $data_barang['harga'];

                // Menyimpan detail transaksi
                $simpan = mysqli_query($koneksi, "
                    INSERT INTO transaksi_detail
                    (transaksi_id, barang_id, harga, qty)
                    VALUES ($transaksi, $barang, $harga, $qty)
                ");

                if ($simpan) {

                    // Menghitung ulang seluruh total transaksi
                    $hitung = mysqli_query($koneksi, "
                        SELECT COALESCE(SUM(harga * qty), 0) AS total_baru
                        FROM transaksi_detail
                        WHERE transaksi_id = $transaksi
                    ");

                    $hasil = mysqli_fetch_assoc($hitung);
                    $total_baru = (int) $hasil['total_baru'];

                    // Memperbarui total pada tabel transaksi
                    mysqli_query($koneksi, "
                        UPDATE transaksi
                        SET total = $total_baru
                        WHERE id = $transaksi
                    ");

                    header("Location: master_detail.php?transaksi_id=$transaksi");
                    exit();

                } else {

                    $error = "Gagal menyimpan barang. Pastikan barang belum ditambahkan.";
                }
            }
        }
    }
}

// Mengambil barang yang sudah digunakan pada transaksi ini
$cekbarang = mysqli_query($koneksi, "
    SELECT barang_id
    FROM transaksi_detail
    WHERE transaksi_id = $transaksi
");

$terpakai = [];

while ($row = mysqli_fetch_assoc($cekbarang)) {
    $terpakai[] = $row['barang_id'];
}

// Mengambil semua data barang
$barang = mysqli_query($koneksi, "
    SELECT * FROM barang
    ORDER BY id ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Tambah Barang Transaksi</h2>
    <p>Menambahkan barang ke transaksi #<?= $transaksi; ?></p>

    <div class="menu">
        <a href="master_detail.php?transaksi_id=<?= $transaksi; ?>"
           class="btn btn-gray">
            Kembali
        </a>
    </div>

    <div class="section">

        <div class="section-title">Form Tambah Barang</div>

        <?php if ($error != ""): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Pilih Barang</label>

            <select name="barang_id" required>

                <option value="">-- Pilih Barang --</option>

                <?php while ($b = mysqli_fetch_assoc($barang)): ?>

                    <?php $sudah_dipilih = in_array($b['id'], $terpakai); ?>

                    <option value="<?= $b['id']; ?>"
                        <?= $sudah_dipilih ? 'disabled' : ''; ?>>

                        <?= htmlspecialchars($b['kode_barang']); ?>
                        -
                        <?= htmlspecialchars($b['nama_barang']); ?>

                        (Rp <?= number_format($b['harga'], 0, ',', '.'); ?>)

                        <?= $sudah_dipilih ? ' - Sudah Ditambahkan' : ''; ?>

                    </option>

                <?php endwhile; ?>

            </select>

            <label>Jumlah Barang (Qty)</label>

            <input type="number"
                   name="qty"
                   min="1"
                   value="1"
                   required>

            <br><br>

            <button type="submit"
                    name="simpan"
                    class="btn btn-green">
                Simpan Barang
            </button>

        </form>

    </div>

</div>

</body>
</html>
