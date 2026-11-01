<?php
require "koneksi.php";

$id = (int) $_GET['id'];

mysqli_query($koneksi, "delete from supplier where id=$id");

header("Location: main.php");
exit;