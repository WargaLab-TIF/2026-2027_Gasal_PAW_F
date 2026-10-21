<?php 
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$pratikum =  ["JARKOM","PAW"];

for ($i=0; $i < count($matkul); $i++) { 
	if ($matkul[$i] == $pratikum[0] || $matkul[$i] == $pratikum[1] ) {
		echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk pratikumnya<br>";
	} elseif ($i == 6 || $i == 7) {
		echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
	} else {
		echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu<br>";
	}
}
 ?>