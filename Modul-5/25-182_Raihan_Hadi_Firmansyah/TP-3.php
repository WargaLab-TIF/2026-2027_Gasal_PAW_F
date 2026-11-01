    <?php
    require 'koneksi.php';

    $daftar_tabel = array(
        "pelanggan",
        "transaksi",
        "transaksi_detail",
        "barang",
        "supplier",
        "user",
        "pembayaran"
    );

    $tabel = isset($_GET['tabel']) ? $_GET['tabel'] : '';

    if (!in_array($tabel, $daftar_tabel)) {
        die("Tabel tidak ditemukan!");
    }

    // Mengambil nama kolom dan primary key
    $query_kolom = mysqli_query($conn, "SHOW COLUMNS FROM `$tabel`");

    $daftar_kolom = array();
    $primary_key = array();

    while ($data_kolom = mysqli_fetch_assoc($query_kolom)) {
        $daftar_kolom[] = $data_kolom['Field'];

        if ($data_kolom['Key'] == 'PRI') {
            $primary_key[] = $data_kolom['Field'];
        }
    }

    // Proses hapus data
    if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
        $kondisi = array();

        foreach ($primary_key as $field) {
            if (!isset($_GET[$field])) {
                die("Primary key tidak lengkap!");
            }

            $id = mysqli_real_escape_string($conn, $_GET[$field]);
            $kondisi[] = "`$field`='$id'";
        }

        $where = implode(" AND ", $kondisi);
        $query_hapus = "DELETE FROM `$tabel` WHERE $where";

        if (mysqli_query($conn, $query_hapus)) {
            header("Location: TP-3.php?tabel=" . urlencode($tabel));
            exit;
        } else {
            $pesan_error = "Data gagal dihapus karena mungkin masih digunakan oleh tabel lain.";
        }
    }

    // Mengambil data dari tabel
    $query = "SELECT * FROM `$tabel`";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Gagal mengambil data: " . mysqli_error($conn));
    }
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Data <?php echo htmlspecialchars(ucfirst($tabel)); ?></title>

        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 35px;
                color: #333;
            }
            h2 {
                color: #337ab7;
                font-size: 24px;
                font-weight: normal;
                margin-bottom: 20px;
            }
            .bagian-atas {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .bagian-kiri {
                display: flex;
                align-items: center;
                gap: 5px;
                margin: 0;
            }
            select {
                padding: 10px;
                font-size: 14px;
            }
            button {
                background-color: #28a745;
                color: white;
                border: none;
                padding: 11px 12px;
                font-size: 14px;
                cursor: pointer;
            }
            .tambah {
                background-color: #5cb85c;
                color: white;
                padding: 10px 15px;
                text-decoration: none;
                display: inline-block;
                border-radius: 3px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 15px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #d9edf7;
                font-weight: bold;
            }
            .edit {
                background-color: #e87516;
                color: white;
                padding: 9px 12px;
                text-decoration: none;
                display: inline-block;
                border-radius: 3px;
            }
            .hapus {
                background-color: #c82333;
                color: white;
                padding: 9px 12px;
                text-decoration: none;
                display: inline-block;
                border-radius: 3px;
            }
            .error {
                color: red;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
    <h2>Data <?php echo htmlspecialchars(ucfirst($tabel)); ?></h2>

    <div class="bagian-atas">
        <form method="GET" action="TP-3.php" class="bagian-kiri">
            <label>Pilih Tabel:</label>
            <select name="tabel">
                <?php
                foreach ($daftar_tabel as $nama_tabel) {
                    echo '<option value="' . htmlspecialchars($nama_tabel) . '"';
                    if ($tabel == $nama_tabel) {
                        echo ' selected';
                    }
                    echo '>' . htmlspecialchars($nama_tabel) . '</option>';
                }
                ?>
            </select>
            <button type="submit">Tampilkan</button>
        </form>

        <a class="tambah" href="TP-4.php?tabel=<?php echo urlencode($tabel); ?>">
            Tambah Data
        </a>
    </div>

    <?php
    if (isset($pesan_error)) {
        echo '<p class="error">' . htmlspecialchars($pesan_error) . '</p>';
    }
    ?>

    <table>
        <tr>
            <?php
            foreach ($daftar_kolom as $nama_kolom) {
                echo '<th>' . htmlspecialchars($nama_kolom) . '</th>';
            }
            echo '<th>Aksi</th>';
            ?>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach ($daftar_kolom as $nama_kolom) {
                echo '<td>' . htmlspecialchars($row[$nama_kolom] ?? '') . '</td>';
            }

            $parameter_id = '';
            foreach ($primary_key as $nama_kolom) {
                $parameter_id .= '&' . urlencode($nama_kolom) . '=' .
                    urlencode($row[$nama_kolom]);
            }

            echo '<td>';
            echo '<a class="edit" href="TP-5.php?tabel=' .
                urlencode($tabel) . $parameter_id . '">Edit</a> ';
            echo '<a class="hapus" href="TP-3.php?tabel=' .
                urlencode($tabel) . $parameter_id .
                '&aksi=hapus" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>';

            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    </body>
    </html>