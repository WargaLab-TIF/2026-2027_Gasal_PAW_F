<?php 
	$height = ["Andy"=>"176", "Barry"=>"165", "Carlie"=>"170"];
	$height["David"] = "180";
	$height["Ethan"] = "172";
	$height["Frank"] = "168";
	$height["George"] = "175";
	$height["Harry"] = "182";
	$nama = array_keys($height);
	$panjang = count($height);
	$values = array_values($height);
	for ($i=0; $i < $panjang; $i++) { 
		echo $nama[$i] . " is " . $values[$i] . " cm tall <br>";
	}
?>