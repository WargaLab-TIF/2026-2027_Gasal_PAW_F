
<?php
include 'koneksi.php';

if (!isset($_GET['transaksi_id'])) {
    die("ID transaksi tidak ditemukan.");
}

$id_transaksi = (int) $_GET['transaksi_id'];

if ($id_transaksi <= 0) {
    die("ID transaksi tidak valid.");
}

// Memastikan transaksi tersedia
$stmt_transaksi = mysqli_prepare(
    $koneksi,
    "SELECT id FROM transaksi WHERE id = ?"
);

mysqli_stmt_bind_param($stmt_transaksi, "i", $id_transaksi);
mysqli_stmt_execute($stmt_transaksi);

$result_transaksi = mysqli_stmt_get_result($stmt_transaksi);

if (mysqli_num_rows($result_transaksi) == 0) {
    die("Transaksi tidak ditemukan.");
}

$query_dipakai = "
    SELECT barang_id
    FROM transaksi_detail
    WHERE transaksi_id = ?
";

$stmt_dipakai = mysqli_prepare($koneksi, $query_dipakai);
mysqli_stmt_bind_param($stmt_dipakai, "i", $id_transaksi);
mysqli_stmt_execute($stmt_dipakai);

$result_dipakai = mysqli_stmt_get_result($stmt_dipakai);

$barang_dipakai = [];

while ($row = mysqli_fetch_assoc($result_dipakai)) {
    $barang_dipakai[] = $row['barang_id'];
}

if (isset($_POST['simpan'])) {

    $barang_id = (int) $_POST['barang_id'];
    $qty = (int) $_POST['qty'];

    if ($barang_id <= 0 || $qty <= 0) {
        $pesan = "Barang dan jumlah harus diisi dengan benar.";
    } else {

        $stmt_harga = mysqli_prepare(
            $koneksi,
            "SELECT harga FROM barang WHERE id = ?"
        );

        mysqli_stmt_bind_param($stmt_harga, "i", $barang_id);
        mysqli_stmt_execute($stmt_harga);

        $result_harga = mysqli_stmt_get_result($stmt_harga);
        $data_harga = mysqli_fetch_assoc($result_harga);

        if (!$data_harga) {
            $pesan = "Barang tidak ditemukan.";
        } elseif (in_array($barang_id, $barang_dipakai)) {
            $pesan = "Barang tersebut sudah ada dalam transaksi.";
        } else {

            $harga = $data_harga['harga'];

            $query_insert = "
                INSERT INTO transaksi_detail
                (transaksi_id, barang_id, harga, qty)
                VALUES (?, ?, ?, ?)
            ";

            $stmt_insert = mysqli_prepare($koneksi, $query_insert);

            mysqli_stmt_bind_param(
                $stmt_insert,
                "iidi",
                $id_transaksi,
                $barang_id,
                $harga,
                $qty
            );

            if (mysqli_stmt_execute($stmt_insert)) {

                $query_update = "
                    UPDATE transaksi
                    SET total = (
                        SELECT COALESCE(SUM(harga * qty), 0)
                        FROM transaksi_detail
                        WHERE transaksi_id = ?
                    )
                    WHERE id = ?
                ";

                $stmt_update = mysqli_prepare($koneksi, $query_update);

                mysqli_stmt_bind_param(
                    $stmt_update,
                    "ii",
                    $id_transaksi,
                    $id_transaksi
                );

                mysqli_stmt_execute($stmt_update);

                header("Location: transaksi.php?id=" . $id_transaksi);
                exit;

            } else {
                $pesan = "Gagal menambahkan detail transaksi.";
            }
        }
    }
}
$query_barang = mysqli_query(
    $koneksi,
    "SELECT * FROM barang ORDER BY nama_barang ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Tambah Detail Transaksi</h2>

    <?php if (isset($pesan)): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Barang</label>

            <select name="barang_id" id="barang_id" required
                    onchange="isiHarga()">

                <option value="">Pilih Barang</option>

                <?php while ($barang = mysqli_fetch_assoc($query_barang)): ?>

                    <option
                        value="<?= $barang['id'] ?>"
                        data-harga="<?= $barang['harga'] ?>"
                        <?= in_array($barang['id'], $barang_dipakai) ? 'disabled' : '' ?>
                    >
                        <?= htmlspecialchars($barang['nama_barang']) ?>
                        <?= in_array($barang['id'], $barang_dipakai) ? '(Sudah digunakan)' : '' ?>
                    </option>

                <?php endwhile; ?>

            </select>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="text" id="harga" readonly>
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="qty" min="1" required>
        </div>

        <div class="form-button">
            <button type="submit" name="simpan">Simpan</button>
            <a href="transaksi.php?id=<?= $id_transaksi ?>">Kembali</a>
        </div>

    </form>

</div>

<script>
function isiHarga() {
    let barang = document.getElementById("barang_id");
    let harga = document.getElementById("harga");

    let pilihan = barang.options[barang.selectedIndex];
    let nilaiHarga = pilihan.getAttribute("data-harga");

    if (nilaiHarga) {
        harga.value = "Rp " + Number(nilaiHarga).toLocaleString("id-ID");
    } else {
        harga.value = "";
    }
}
</script>

</body>
</html>
