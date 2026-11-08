<?php 
	$fruits = ["Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew"];
	unset($fruits[1]);
	echo "Data Blueberry telah dihapus" . "<br>";
	echo "fruits : (";
	foreach ($fruits as $data) {
		echo " $data,";
	}
	echo " )";
	echo "<br>Nilai dengan indeks tertinggi : " . $fruits[7];
?>