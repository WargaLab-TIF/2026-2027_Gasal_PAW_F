    <?php
    require_once __DIR__ .'/TP5-koneksi.php';

    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");
    header("Location: TP5-main.php");