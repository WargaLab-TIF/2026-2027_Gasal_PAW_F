<?php
try{
    $conn = mysqli_connect("localhost","root","","penjualan");
    
}catch(mysqli_sql_exception $e){
    die('Connection failed: ' . $e->getMessage());
}

?>