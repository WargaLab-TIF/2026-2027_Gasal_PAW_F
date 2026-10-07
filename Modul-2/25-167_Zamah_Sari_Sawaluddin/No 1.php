<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$praktikum = array("JARKOM", "PAW");

for($i = 0; $i <8; $i++) {
	if($matkul[$i] == $praktikum[0] and $matkul[$i] == $praktikum[1]) {
		echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya";
		echo "<br>";
	} elseif($i == 6 and $i == 7) {
		echo "saya belum mengambil matkul " . $matkul[$i];
		echo "<br>";
	} else {
		echo "saya sudah mengambil matkul " . $matkul[$i] . " semester lalu";
		echo "<br>";
	}
}
?>