<?php 
	$weight = ["Andy"=>"70", "Barry"=>"65", "Charlie"=>"75"];
	$nama = array_keys($weight);
	$panjang = count($weight);
	$values = array_values($weight);
	for ($i=0; $i < $panjang; $i++) { 
		echo $nama[$i] . " is " . $values[$i] . " kg <br>";
		}
?>