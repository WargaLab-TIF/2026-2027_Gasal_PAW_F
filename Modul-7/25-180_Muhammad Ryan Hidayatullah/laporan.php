<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'Modul_7';

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}
mysqli_set_charset($koneksi, 'utf8mb4');

function e($teks) {
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

// ===== SOAL 1 (PHP): Filter rentang tanggal =====
$tanggal_mulai   = $_GET['tanggal_mulai'] ?? '';
$tanggal_selesai = $_GET['tanggal_selesai'] ?? '';

$tampil = false;   
$error  = '';
$rekap  = [];      
$pola   = '/^\d{4}-\d{2}-\d{2}$/';   

if ($tanggal_mulai != '' && $tanggal_selesai != '') {
    if (!preg_match($pola, $tanggal_mulai) ||
        !preg_match($pola, $tanggal_selesai)) {
        $error = 'Format tanggal tidak valid.';
    } elseif ($tanggal_mulai > $tanggal_selesai) {
        $error = 'Tanggal mulai tidak boleh lebih besar '
               . 'dari tanggal selesai.';
    } else {
        $tampil = true;

        $sql = "SELECT DATE(waktu_transaksi) AS tanggal,
                       SUM(total) AS total_harian
                FROM transaksi
                WHERE waktu_transaksi BETWEEN ? AND ?
                GROUP BY DATE(waktu_transaksi)
                ORDER BY tanggal ASC";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, 'ss',
            $tanggal_mulai, $tanggal_selesai);
        mysqli_stmt_execute($stmt);
        $hasil = mysqli_stmt_get_result($stmt);
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $rekap[] = $baris;
        }
    }
}

// ===== SOAL 3 (PHP): Ringkasan total kumulatif =====
function rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

$jumlah_pelanggan = 0;
$total_pendapatan = 0;

if ($tampil) {
    $sql2 = "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan,
                    COALESCE(SUM(total), 0) AS total_pendapatan
             FROM transaksi
             WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt2 = mysqli_prepare($koneksi, $sql2);
    mysqli_stmt_bind_param($stmt2, 'ss',
        $tanggal_mulai, $tanggal_selesai);
    mysqli_stmt_execute($stmt2);
    $ringkas = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2));

    $jumlah_pelanggan = (int)$ringkas['jml_pelanggan'];
    $total_pendapatan = (int)$ringkas['total_pendapatan'];
}

// ===== SOAL 4 (PHP): Ekspor ke Excel (.xls) =====
if ($tampil && ($_GET['export'] ?? '') == 'excel') {
    $nama_file = 'rekap_penjualan_' . $tanggal_mulai
               . '_sd_' . $tanggal_selesai . '.xls';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="'
           . $nama_file . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    echo '<meta charset="UTF-8">';
    echo '<table border="1">';
    echo '<tr><th colspan="3">Rekap Laporan Penjualan '
       . $tanggal_mulai . ' sampai ' . $tanggal_selesai
       . '</th></tr>';
    echo '<tr><th>No</th><th>Total Pendapatan</th>'
       . '<th>Tanggal Transaksi</th></tr>';

    $no = 1;
    foreach ($rekap as $r) {
        $tgl = date('d-m-Y', strtotime($r['tanggal']));
        echo '<tr><td>' . $no++ . '</td>'
           . '<td>' . $r['total_harian'] . '</td>'
           . '<td>' . $tgl . '</td></tr>';
    }
    echo '<tr><td colspan="2"><b>Jumlah Pelanggan Unik</b></td>'
       . '<td>' . $jumlah_pelanggan . ' Orang</td></tr>';
    echo '<tr><td colspan="2"><b>Total Pendapatan Keseluruhan</b>'
       . '</td><td>' . $total_pendapatan . '</td></tr>';
    echo '</table>';
    exit;   
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Penjualan</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* ===== SOAL 1 (CSS): Tampilan dasar dan form filter ===== */
body { font-family: Arial, sans-serif; background: #f4f6f8;
       color: #222; margin: 0; }
.container { max-width: 900px; margin: 0 auto; padding: 20px; }
h1 small { font-size: 14px; font-weight: normal; color: #555; }
.filter { background: #fff; padding: 12px; border-radius: 4px;
          margin-bottom: 12px; }
.filter input { padding: 6px; margin-right: 10px; }
.btn { display: inline-block; padding: 7px 14px; border: 0;
       border-radius: 3px; color: #fff; cursor: pointer;
       font-size: 14px; text-decoration: none; }
.biru { background: #0d47a1; }
.error { background: #fdecea; color: #b71c1c; padding: 10px;
         border-radius: 4px; }
.info { background: #e3f2fd; color: #0d47a1; padding: 10px;
        border-radius: 4px; }

/* ===== SOAL 2 (CSS): Kotak grafik ===== */
.kotak-grafik { position: relative; height: 320px;
                background: #fff; padding: 10px;
                border-radius: 4px; }

/* ===== SOAL 3 (CSS): Tabel rekapitulasi dan card ringkasan ===== */
table { border-collapse: collapse; width: 100%; background: #fff;
        margin-top: 15px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background: #d9edf7; }
.kartu-ringkasan { display: flex; gap: 15px; margin-top: 15px; }
.kartu { flex: 1; background: #fff; border: 1px solid #ccc;
         border-radius: 4px; overflow: hidden; }
.kartu-judul { background: #d9edf7; padding: 8px 12px;
               font-weight: bold; }
.kartu-isi { padding: 14px 12px; font-size: 20px;
             text-align: right; }

/* ===== SOAL 4 (CSS): Tombol aksi dan aturan cetak ===== */
.aksi { margin: 12px 0; }
.oranye { background: #e65100; }

@media print {
    .no-print { display: none !important; }

    body { background: #fff; }
    .container { max-width: 100%; padding: 0; }

    * { -webkit-print-color-adjust: exact;
        print-color-adjust: exact; }

    table, .kartu-ringkasan { page-break-inside: avoid; }
}
</style>
</head>
<body>
<div class="container">

<!-- ===== SOAL 1 (HTML): Judul, form filter, dan pesan ===== -->
<h1>Rekap Laporan Penjualan</h1>

<form method="GET" class="filter no-print">
    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai"
           value="<?= e($tanggal_mulai) ?>" required>
    <label>Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai"
           value="<?= e($tanggal_selesai) ?>" required>
    <button type="submit" class="btn biru">Tampilkan</button>
</form>

<?php if ($error != ''): ?>
    <div class="error"><?= e($error) ?></div>
<?php endif; ?>

<?php if ($tampil && empty($rekap)): ?>
    <div class="info">Tidak ada transaksi pada rentang tanggal
    tersebut.</div>
<?php endif; ?>

<!-- ===== SOAL 4 (HTML): Tombol Cetak dan Excel ===== -->
<?php if ($tampil && !empty($rekap)): ?>
<?php
// Parameter filter + export=excel diteruskan ke halaman ini lagi
$qs = http_build_query([
    'tanggal_mulai'   => $tanggal_mulai,
    'tanggal_selesai' => $tanggal_selesai,
    'export'          => 'excel'
]);
?>
<div class="aksi no-print">
    <button type="button" class="btn oranye"
            onclick="window.print()">Cetak</button>
    <a class="btn oranye" href="?<?= e($qs) ?>">Excel</a>
</div>
<?php endif; ?>

<!-- ===== SOAL 2 (HTML + JavaScript): Grafik batang Chart.js ===== -->
<?php if ($tampil && !empty($rekap)): ?>
<h2>Grafik Penjualan Harian</h2>
<div class="kotak-grafik">
    <canvas id="grafikPenjualan"></canvas>
</div>
<script>
const labelTanggal = <?= json_encode(
                         array_column($rekap, 'tanggal')) ?>;
const dataTotal = <?= json_encode(array_map('intval',
                      array_column($rekap, 'total_harian'))) ?>;
const rp = (n) => 'Rp ' + Number(n).toLocaleString('id-ID');

new Chart(document.getElementById('grafikPenjualan'), {
    type: 'bar',
    data: {
        labels: labelTanggal,
        datasets: [{
            label: 'Total Pendapatan',
            data: dataTotal,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: false,
        scales: {
            x: { title: { display: true,
                          text: 'Tanggal Transaksi' } },
            y: {
                beginAtZero: true,
                title: { display: true,
                         text: 'Total Pendapatan (Rp)' },
                ticks: { callback: (v) => rp(v) }
            }
        },
        plugins: {
            tooltip: { callbacks: { label: (c) => rp(c.parsed.y) } }
        }
    }
});
</script>
<?php endif; ?>

<!-- ===== SOAL 3 (HTML): Tabel rekapitulasi dan card ===== -->
<?php if ($tampil && !empty($rekap)): ?>
<h2>Rekapitulasi Penjualan Harian</h2>
<table>
    <thead>
        <tr>
            <th width="60">No</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1; foreach ($rekap as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= rupiah($r['total_harian']) ?></td>
            <td><?= date('d-m-Y', strtotime($r['tanggal'])) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="kartu-ringkasan">
    <div class="kartu">
        <div class="kartu-judul">Jumlah Pelanggan Unik</div>
        <div class="kartu-isi"><?= $jumlah_pelanggan ?> Orang</div>
    </div>
    <div class="kartu">
        <div class="kartu-judul">Total Pendapatan Keseluruhan</div>
        <div class="kartu-isi"><?= rupiah($total_pendapatan) ?></div>
    </div>
</div>
<?php endif; ?>

</div>
</body>
</html>
