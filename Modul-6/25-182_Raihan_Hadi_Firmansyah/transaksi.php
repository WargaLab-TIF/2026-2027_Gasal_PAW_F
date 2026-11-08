<?php
include 'koneksi.php';

// Mengambil ID transaksi
if (isset($_GET['id'])) {
    $id_trx = $_GET['id'];
} else {
    $query = mysqli_query($koneksi, "SELECT id FROM transaksi ORDER BY id ASC LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $id_trx = $data['id'];
    } else {
        $id_trx = 0;
    }
}

// Menambahkan barang ke transaksi
if (isset($_POST['tambah']) && $id_trx != 0) {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $query = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = '$barang_id'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $harga = $data['harga'];

        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                                VALUES ('$id_trx', '$barang_id', '$harga', '$qty')");

        // Menghitung total transaksi
        $query = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total
                                         FROM transaksi_detail
                                         WHERE transaksi_id = '$id_trx'");

        $data = mysqli_fetch_assoc($query);
        $total = $data['total'];

        // Mengambil nama semua barang
        $query_keterangan = mysqli_query($koneksi, "
            SELECT GROUP_CONCAT(barang.nama_barang SEPARATOR ', ') AS daftar_barang
            FROM transaksi_detail
            JOIN barang ON transaksi_detail.barang_id = barang.id
            WHERE transaksi_detail.transaksi_id = '$id_trx'
        ");

        $data_keterangan = mysqli_fetch_assoc($query_keterangan);
        $keterangan = "Pembelian " . $data_keterangan['daftar_barang'];

        // Memperbarui total dan keterangan transaksi
        mysqli_query($koneksi, "
            UPDATE transaksi
            SET total = '$total', keterangan = '$keterangan'
            WHERE id = '$id_trx'
        ");
    }

    header("Location: transaksi.php?id=" . $id_trx);
    exit;
}

// Menghapus barang dari transaksi
if (isset($_GET['hapus_brg']) && $id_trx != 0) {
    $barang_id = $_GET['hapus_brg'];

    mysqli_query($koneksi, "DELETE FROM transaksi_detail
                            WHERE transaksi_id = '$id_trx'
                            AND barang_id = '$barang_id'");

    // Menghitung ulang total transaksi
    $query = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total
                                     FROM transaksi_detail
                                     WHERE transaksi_id = '$id_trx'");

    $data = mysqli_fetch_assoc($query);
    $total = $data['total'];

    if ($total == NULL) {
        $total = 0;
    }

    // Mengambil nama semua barang yang tersisa
    $query_keterangan = mysqli_query($koneksi, "
        SELECT GROUP_CONCAT(barang.nama_barang SEPARATOR ', ') AS daftar_barang
        FROM transaksi_detail
        JOIN barang ON transaksi_detail.barang_id = barang.id
        WHERE transaksi_detail.transaksi_id = '$id_trx'
    ");

    $data_keterangan = mysqli_fetch_assoc($query_keterangan);

    if ($data_keterangan['daftar_barang'] != NULL) {
        $keterangan = "Pembelian " . $data_keterangan['daftar_barang'];
    } else {
        $keterangan = "";
    }

    // Memperbarui total dan keterangan transaksi
    mysqli_query($koneksi, "
        UPDATE transaksi
        SET total = '$total', keterangan = '$keterangan'
        WHERE id = '$id_trx'
    ");

    header("Location: transaksi.php?id=" . $id_trx);
    exit;
}

// Mengambil data transaksi
$query_master = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama
                                        FROM transaksi
                                        LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
                                        ORDER BY transaksi.id ASC");

// Mengambil daftar barang yang belum dimasukkan
if ($id_trx != 0) {
    $query_barang = mysqli_query($koneksi, "SELECT * FROM barang
                                            WHERE id NOT IN (
                                                SELECT barang_id
                                                FROM transaksi_detail
                                                WHERE transaksi_id = '$id_trx'
                                            )");

    // Mengambil detail transaksi
    $query_detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.kode_barang, barang.nama_barang
                                            FROM transaksi_detail
                                            JOIN barang ON transaksi_detail.barang_id = barang.id
                                            WHERE transaksi_detail.transaksi_id = '$id_trx'");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            padding: 15px 25px;
            color: #555;
            font-size: 13px;
        }

        .kotak {
            background-color: white;
            margin-bottom: 30px;
        }

        h2, h3 {
            color: #56849c;
            font-size: 18px;
            font-weight: normal;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 9px 6px;
            text-align: left;
        }

        th {
            background-color: #d9edf7;
            color: #555;
        }

        .baris-aktif td {
            background-color: #eef7fc;
            font-weight: bold;
        }

        .tombol-tambah {
            background-color: #7cb342;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .tombol-pilih {
            background-color: #e87517;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 3px;
        }

        .tombol-hapus {
            background-color: #d9534f;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 3px;
        }

        select, input {
            padding: 7px;
            margin-right: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form {
            margin-bottom: 15px;
        }

        button:hover, a:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

    <div class="kotak">
        <h2>Data Master Transaksi</h2>

        <p>
            <a href="barang.php" class="tombol-tambah">Data Barang</a>
        </p>

        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($query_master)) {
                if ($row['id'] == $id_trx) {
                    echo "<tr class='baris-aktif'>";
                } else {
                    echo "<tr>";
                }

                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['waktu_transaksi'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['keterangan'] . "</td>";
                echo "<td>Rp " . number_format($row['total']) . "</td>";
                echo "<td><a href='transaksi.php?id=" . $row['id'] . "' class='tombol-pilih'>Pilih Detail</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="kotak">
        <h3>Data Detail Transaksi <?php echo $id_trx; ?></h3>

        <?php
        if ($id_trx != 0) {
            echo "<form method='POST'>";

            echo "<label>Barang:</label>";
            echo "<select name='barang_id' required>";
            echo "<option value=''>-- Pilih Barang --</option>";

            while ($brg = mysqli_fetch_assoc($query_barang)) {
                echo "<option value='" . $brg['id'] . "'>";
                echo $brg['nama_barang'] . " (Rp " . number_format($brg['harga']) . ")";
                echo "</option>";
            }

            echo "</select>";

            echo "<label>Qty:</label>";
            echo "<input type='number' name='qty' min='1' value='1' required style='width: 60px;'>";

            echo "<button type='submit' name='tambah' class='tombol-tambah'>Tambah Barang</button>";
            echo "</form>";

            echo "<table>";
            echo "<tr>";
            echo "<th>Kode</th>";
            echo "<th>Nama Barang</th>";
            echo "<th>Harga</th>";
            echo "<th>Qty</th>";
            echo "<th>Subtotal</th>";
            echo "<th>Tindakan</th>";
            echo "</tr>";

            if (mysqli_num_rows($query_detail) > 0) {
                while ($det = mysqli_fetch_assoc($query_detail)) {
                    $subtotal = $det['harga'] * $det['qty'];

                    echo "<tr>";
                    echo "<td>" . $det['kode_barang'] . "</td>";
                    echo "<td>" . $det['nama_barang'] . "</td>";
                    echo "<td>Rp " . number_format($det['harga']) . "</td>";
                    echo "<td>" . $det['qty'] . "</td>";
                    echo "<td>Rp " . number_format($subtotal) . "</td>";
                    echo "<td><a href='transaksi.php?id=" . $id_trx . "&hapus_brg=" . $det['barang_id'] . "' class='tombol-hapus' onclick=\"return confirm('Hapus barang ini?')\">Hapus</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Belum ada barang pada transaksi ini.</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Belum ada data transaksi.</p>";
        }
        ?>
    </div>
</body>
</html>