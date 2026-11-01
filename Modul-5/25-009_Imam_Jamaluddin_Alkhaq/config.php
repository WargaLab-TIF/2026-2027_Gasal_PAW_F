<?php
	$s = "localhost";
	$u = "root";
	$p = "";
	$d = "toko_jaya";

	$conn = mysqli_connect($s,$u,$p,$d);
	if (!$conn) {
	die('Gagal terhubung dengan database: ' . mysqli_connect_error());
	}

 ?>