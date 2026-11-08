<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // error -> exception

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'penjualan';

try {
    $db = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $db->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Koneksi database gagal: ' . htmlspecialchars($e->getMessage()));
}

session_start();

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function rupiah($n) { return 'Rp ' . number_format((int)$n, 0, ',', '.'); }

function set_flash($tipe, $pesan) { $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan]; }
function tampil_flash() {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        echo '<div class="alert ' . e($f['tipe']) . '">' . e($f['pesan']) . '</div>';
    }
}

function hitung_ulang_total(mysqli $db, int $transaksi_id): int {
    $stmt = $db->prepare(
        'UPDATE transaksi
            SET total = (SELECT COALESCE(SUM(harga * qty), 0)
                           FROM transaksi_detail
                          WHERE transaksi_id = ?)
          WHERE id = ?'
    );
    $stmt->bind_param('ii', $transaksi_id, $transaksi_id);
    $stmt->execute();
    $stmt->close();

    $stmt = $db->prepare('SELECT total FROM transaksi WHERE id = ?');
    $stmt->bind_param('i', $transaksi_id);
    $stmt->execute();
    $total = (int)$stmt->get_result()->fetch_row()[0];
    $stmt->close();
    return $total;
}
