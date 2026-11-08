
<?php
require_once "koneksi.php";

$sql = "DELETE FROM supplier WHERE id = " . $_GET['id'];

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
