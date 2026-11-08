<?php 
	$height = ["Andi"=>"176", "Bary"=>"165", "Charlie"=>"170"];
	$height["David"] = "180";
	$height["Ethan"] = "172";
	$height["Frank"] = "168";
	$height["George"] = "175";
	$height["Harry"] = "182";
	echo "height : ";
	foreach ($height as $x => $y) {
	  echo "$x: $y, ";
	}
	echo "nilai dengan index terakhir : " . $height["Harry"];
	
	unset($height["Bary"]);
	echo "<br><br>height : ";
	foreach ($height as $j => $b) {
	  echo "$j: $b, ";
	}
	echo "nilai dengan index terakhir : " . $height["Harry"];
?>