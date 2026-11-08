<?php
include "koneksi.php";
include "pengaturan.php";

if (!isset($_GET["tabel"])) {
    header("Location: index.php");
    exit;
}

$tabel = $_GET["tabel"];
if (!isset($daftar_tabel[$tabel])) {
    header("Location: index.php");
    exit;
}

if ($tabel == "transaksi_detail") {
    header("Location: index.php?tabel=transaksi_detail");
    exit;
}

$data_edit = array();

if (isset($_POST["simpan"])) {
    $kolom = "";
    $nilai = "";

    foreach ($daftar_tabel[$tabel]["field"] as $field) {
        $nama_field = $field["nama"];
        $isi = $_POST[$nama_field];
        if ($field["tipe"] == "datetime-local") {
            $isi = str_replace("T", " ", $isi);
        }
        $isi = mysqli_real_escape_string($koneksi, $isi);

        if ($kolom != "") {
            $kolom .= ", ";
            $nilai .= ", ";
        }
        $kolom .= "`" . $nama_field . "`";
        $nilai .= "'" . $isi . "'";
    }

    $sql = "INSERT INTO `$tabel` ($kolom) VALUES ($nilai)";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php?tabel=" . $tabel . "&pesan=tambah");
        exit;
    } else {
        $pesan_error = "Data gagal ditambahkan: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form-page">
<div class="form-container">
    <div class="topline">
        <div><h1>Tambah Data</h1><p class="muted">Tabel: <?php echo $daftar_tabel[$tabel]["judul"]; ?></p></div>
    </div>
    <?php if (isset($pesan_error)) { ?><div class="alert error"><?php echo $pesan_error; ?></div><?php } ?>
    <form method="POST" action="">
        <div class="form-grid">
            <?php
foreach ($daftar_tabel[$tabel]["field"] as $field) {
    $nama_field = $field["nama"];
    $nilai = "";
    if (isset($data_edit[$nama_field])) {
        $nilai = $data_edit[$nama_field];
    }

    if ($field["tipe"] == "supplier") {
        $hasil_pilihan = mysqli_query($koneksi, "SELECT id, nama FROM supplier");
    } else if ($field["tipe"] == "pelanggan") {
        $hasil_pilihan = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan");
    } else if ($field["tipe"] == "barang") {
        $hasil_pilihan = mysqli_query($koneksi, "SELECT id, nama_barang FROM barang");
    } else if ($field["tipe"] == "transaksi") {
        $hasil_pilihan = mysqli_query($koneksi, "SELECT id FROM transaksi");
    }
    ?>
    <div class="form-group">
        <label><?php echo $field["label"]; ?></label>
        <?php if ($field["tipe"] == "textarea") { ?>
            <textarea name="<?php echo $nama_field; ?>"><?php echo htmlspecialchars($nilai); ?></textarea>
        <?php } else if ($field["tipe"] == "gender") { ?>
            <select name="<?php echo $nama_field; ?>">
                <option value="L" <?php if ($nilai == "L") echo "selected"; ?>>Laki-laki</option>
                <option value="P" <?php if ($nilai == "P") echo "selected"; ?>>Perempuan</option>
            </select>
        <?php } else if ($field["tipe"] == "metode") { ?>
            <select name="<?php echo $nama_field; ?>">
                <option value="TUNAI" <?php if ($nilai == "TUNAI") echo "selected"; ?>>Tunai</option>
                <option value="TRANSFER" <?php if ($nilai == "TRANSFER") echo "selected"; ?>>Transfer</option>
                <option value="EDC" <?php if ($nilai == "EDC") echo "selected"; ?>>EDC</option>
            </select>
        <?php } else if ($field["tipe"] == "supplier" || $field["tipe"] == "pelanggan" || $field["tipe"] == "barang" || $field["tipe"] == "transaksi") { ?>
            <select name="<?php echo $nama_field; ?>">
                <?php while ($pilihan = mysqli_fetch_assoc($hasil_pilihan)) { ?>
                    <?php
                    if ($field["tipe"] == "supplier" || $field["tipe"] == "pelanggan") {
                        $value_pilihan = $pilihan["id"];
                        $nama_pilihan = $pilihan["nama"];
                    } else if ($field["tipe"] == "barang") {
                        $value_pilihan = $pilihan["id"];
                        $nama_pilihan = $pilihan["nama_barang"];
                    } else {
                        $value_pilihan = $pilihan["id"];
                        $nama_pilihan = "Transaksi " . $pilihan["id"];
                    }
                    ?>
                    <option value="<?php echo $value_pilihan; ?>" <?php if ($nilai == $value_pilihan) echo "selected"; ?>><?php echo $nama_pilihan; ?></option>
                <?php } ?>
            </select>
        <?php } else { ?>
            <input type="<?php echo $field["tipe"]; ?>" name="<?php echo $nama_field; ?>" value="<?php echo htmlspecialchars($nilai); ?>" <?php if ($field["tipe"] == "number") echo 'min="0"'; ?> required>
        <?php } ?>
    </div>
    <?php
}
?>
        </div>
        <div class="form-actions">
            <a href="index.php?tabel=<?php echo $tabel; ?>" class="btn btn-light">Kembali</a>
            <button type="submit" name="simpan" class="btn btn-blue">Simpan</button>
        </div>
    </form>
</div>
</body>
</html>