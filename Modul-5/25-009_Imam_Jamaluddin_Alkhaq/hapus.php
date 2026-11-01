<?php

include ('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM supplier WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: index.php');
    } else {
        die('gagal menghapus...');
    }
} else {
    die('akses dilarang...');
}

?>