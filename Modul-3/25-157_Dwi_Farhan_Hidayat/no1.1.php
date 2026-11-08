<?php 
	$fruits = ["Avocado", "Blueberry", "Cherry"];
	array_push($fruits, "Durian", "Elderberry", "Fig", "Grepe", "Honeydew");
	echo "fruits : (";
	foreach ($fruits as $data) {
		echo " $data,";
	}
	echo " )";
	echo "<br> Nilai dengan indeks tertinggi : " . $fruits[7];
?>