<?php
include 'config.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "DELETE FROM supplier WHERE id = ?";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menghapus data supplier.";
    }
}
?>
