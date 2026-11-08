<?php
$servername = "localhost";
$username = "root";
$pass = "";
$database_name = "penjualan";

$conn = mysqli_connect($servername, $username, $pass, $database_name);
if (!$conn){
    die("connected Failed : ".mysqli_connect_error());
}
echo " ";

function e($teks){
    return htmlspecialchars((string)$teks);
}

?>