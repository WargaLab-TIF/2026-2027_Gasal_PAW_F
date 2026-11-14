<?php
include "koneksi.php";
include "pengaturan.php";

// Mengambil tanggal transaksi paling awal dan paling akhir untuk nilai awal filter.
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

$tanggal_mulai = $tanggal_awal_default;
$tanggal_selesai = $tanggal_akhir_default;
$pesan_error = "";
$laporan_harian = array();
$jumlah_pelanggan = 0;
$total_pendapatan = 0;

// Memeriksa format tanggal yang dimasukkan pengguna.
function tanggal_valid($tanggal) {
    $tanggal_objek = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $tanggal_objek && $tanggal_objek->format('Y-m-d') == $tanggal;
}

if (isset($_GET["tampilkan"])) {
    $tanggal_mulai = isset($_GET["tanggal_mulai"]) ? $_GET["tanggal_mulai"] : "";
    $tanggal_selesai = isset($_GET["tanggal_selesai"]) ? $_GET["tanggal_selesai"] : "";
}

if (tanggal_valid($tanggal_mulai) && tanggal_valid($tanggal_selesai)) {
    if ($tanggal_mulai > $tanggal_selesai) {
        $pesan_error = "Tanggal mulai tidak boleh lebih besar dari tanggal selesai.";
    } else {
        $tanggal_mulai_sql = mysqli_real_escape_string($koneksi, $tanggal_mulai);
        $tanggal_selesai_sql = mysqli_real_escape_string($koneksi, $tanggal_selesai);

        $sql_harian = "SELECT DATE(waktu_transaksi) AS tanggal_transaksi,
                              SUM(total) AS total_pendapatan
                       FROM transaksi
                       WHERE DATE(waktu_transaksi) BETWEEN '$tanggal_mulai_sql' AND '$tanggal_selesai_sql'
                       GROUP BY DATE(waktu_transaksi)
                       ORDER BY DATE(waktu_transaksi) ASC";
        $hasil_harian = mysqli_query($koneksi, $sql_harian);

        while ($data_harian = mysqli_fetch_assoc($hasil_harian)) {
            $laporan_harian[] = $data_harian;
        }

        $sql_ringkasan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
                                 COALESCE(SUM(total), 0) AS total_pendapatan
                          FROM transaksi
                          WHERE DATE(waktu_transaksi) BETWEEN '$tanggal_mulai_sql' AND '$tanggal_selesai_sql'";
        $hasil_ringkasan = mysqli_query($koneksi, $sql_ringkasan);
        $data_ringkasan = mysqli_fetch_assoc($hasil_ringkasan);

        $jumlah_pelanggan = (int) $data_ringkasan["jumlah_pelanggan"];
        $total_pendapatan = (float) $data_ringkasan["total_pendapatan"];
    }
} else {
    $pesan_error = "Silakan isi tanggal mulai dan tanggal selesai dengan format yang benar.";
}

$label_grafik = array();
$data_grafik = array();
foreach ($laporan_harian as $baris) {
    $label_grafik[] = date("d-m-Y", strtotime($baris["tanggal_transaksi"]));
    $data_grafik[] = (float) $baris["total_pendapatan"];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporting Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="layout">
    <aside class="sidebar no-print">
        <div class="brand">PENJUALAN<small>DATABASE MANAGEMENT</small></div>
        <div class="menu-title">Menu Utama</div>
        <a class="menu-link" href="index.php">⌂ &nbsp; Dashboard</a>
        <div class="menu-title">Data Master</div>
        <?php
        foreach ($daftar_tabel as $nama_tabel => $isi_tabel) {
            if ($isi_tabel["kelompok"] == "Data Master") {
                ?>
                <a class="menu-link" href="index.php?tabel=<?php echo $nama_tabel; ?>">▤ &nbsp; <?php echo $isi_tabel["judul"]; ?></a>
                <?php
            }
        }
        ?>
        <div class="menu-title">Data Transaksi</div>
        <?php
        foreach ($daftar_tabel as $nama_tabel => $isi_tabel) {
            if ($isi_tabel["kelompok"] == "Data Transaksi") {
                ?>
                <a class="menu-link" href="index.php?tabel=<?php echo $nama_tabel; ?>">▤ &nbsp; <?php echo $isi_tabel["judul"]; ?></a>
                <?php
            }
        }
        ?>
        <div class="menu-title">Laporan</div>
        <a class="menu-link active" href="report.php">▥ &nbsp; Reporting Penjualan</a>
    </aside>

    <main class="main">
        <div class="topline">
            <div>
                <h1>Laporan Penjualan</h1>
                <p class="muted">Rekap pendapatan berdasarkan rentang tanggal transaksi.</p>
            </div>
            <div class="small no-print">Database: penjualan</div>
        </div>

        <div class="panel report-filter no-print">
            <h2>Filter Periode Laporan</h2>
            <form method="GET" action="report.php">
                <div class="report-filter-grid">
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                            value="<?php echo htmlspecialchars($tanggal_mulai); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                            value="<?php echo htmlspecialchars($tanggal_selesai); ?>" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="report.php" class="btn btn-light">Reset</a>
                    <button type="submit" name="tampilkan" value="1" class="btn btn-blue">Tampilkan</button>
                </div>
            </form>
        </div>

        <?php if ($pesan_error != "") { ?>
            <div class="alert error no-print"><?php echo htmlspecialchars($pesan_error); ?></div>
        <?php } else { ?>
            <div class="report-period">
                Periode laporan: <?php echo date("d-m-Y", strtotime($tanggal_mulai)); ?> sampai
                <?php echo date("d-m-Y", strtotime($tanggal_selesai)); ?>
            </div>

            <div class="report-summary">
                <div class="report-card">
                    <span class="report-card-label">Jumlah Pelanggan Unik</span>
                    <strong><?php echo number_format($jumlah_pelanggan, 0, ",", "."); ?></strong>
                    <span class="report-card-note">Pelanggan yang melakukan transaksi pada periode ini</span>
                </div>
                <div class="report-card">
                    <span class="report-card-label">Total Pendapatan Keseluruhan</span>
                    <strong>Rp <?php echo number_format($total_pendapatan, 0, ",", "."); ?></strong>
                    <span class="report-card-note">Akumulasi pendapatan pada periode yang dipilih</span>
                </div>
            </div>

            <div class="panel report-panel">
                <h2>Grafik Pendapatan Harian</h2>
                <p class="muted">Sumbu X menunjukkan tanggal transaksi dan sumbu Y menunjukkan total pendapatan.</p>
                <div class="report-chart">
                    <canvas id="grafikPendapatan"></canvas>
                </div>
                <?php if (count($laporan_harian) == 0) { ?>
                    <p class="empty">Tidak ada transaksi pada rentang tanggal tersebut.</p>
                <?php } ?>
            </div>

            <div class="panel report-panel">
                <h2>Rekapitulasi Penjualan Harian</h2>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Total Pendapatan</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($laporan_harian) > 0) { ?>
                                <?php $no = 1; ?>
                                <?php foreach ($laporan_harian as $baris) { ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>Rp <?php echo number_format((float) $baris["total_pendapatan"], 0, ",", "."); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($baris["tanggal_transaksi"])); ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <tr><td colspan="3" class="empty">Belum ada data penjualan pada periode ini.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="report-actions no-print">
                <a class="btn btn-blue" href="export.php?tanggal_mulai=<?php echo urlencode($tanggal_mulai); ?>&tanggal_selesai=<?php echo urlencode($tanggal_selesai); ?>">Ekspor Excel</a>
                <button type="button" class="btn btn-light" onclick="window.print()">Cetak Laporan</button>
            </div>
        <?php } ?>

        <div class="footer no-print">Aplikasi Praktikum - Reporting Penjualan</div>
    </main>
</div>

<script>
const labelTanggal = <?php echo json_encode($label_grafik); ?>;
const dataPendapatan = <?php echo json_encode($data_grafik); ?>;

const areaGrafik = document.getElementById("grafikPendapatan");

if (areaGrafik && typeof Chart !== "undefined") {
new Chart(areaGrafik, {
    type: "bar",
    data: {
        labels: labelTanggal,
        datasets: [{
            label: "Total Pendapatan",
            data: dataPendapatan,
            backgroundColor: "rgba(49, 95, 206, 0.75)",
            borderColor: "rgba(49, 95, 206, 1)",
            borderWidth: 1,
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(nilai) {
                        return "Rp " + Number(nilai).toLocaleString("id-ID");
                    }
                },
                title: {
                    display: true,
                    text: "Total Pendapatan (Rp)"
                }
            },
            x: {
                title: {
                    display: true,
                    text: "Tanggal Transaksi"
                }
            }
        },
        plugins: {
            legend: {
                display: true
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return "Pendapatan: Rp " + Number(context.raw).toLocaleString("id-ID");
                    }
                }
            }
        }
    }
});
}
</script>
</body>
</html>