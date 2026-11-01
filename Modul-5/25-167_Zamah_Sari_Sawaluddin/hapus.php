<?php
include "koneksi.php";
include "pengaturan.php";

$tabel = $_POST["tabel"];
if (!isset($daftar_tabel[$tabel])) {
    header("Location: index.php");
    exit;
}

$where = "";
foreach ($daftar_tabel[$tabel]["primary"] as $kunci) {
    $nilai_kunci = mysqli_real_escape_string($koneksi, $_POST[$kunci]);
    if ($where != "") {
        $where .= " AND ";
    }
    $where .= "`" . $kunci . "` = '" . $nilai_kunci . "'";
}

$sql = "DELETE FROM `$tabel` WHERE $where";
if (mysqli_query($koneksi, $sql)) {
    header("Location: index.php?tabel=" . $tabel . "&pesan=hapus");
    exit;
} else {
    // Data mungkin masih dipakai oleh tabel lain melalui Foreign Key.
    header("Location: index.php?tabel=" . $tabel . "&pesan=gagal");
    exit;
}
?>
