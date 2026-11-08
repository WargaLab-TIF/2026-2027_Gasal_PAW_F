<?php 
	$fruits = ["Avocado", "Blueberry", "Cherry"];
	array_push($fruits, "Semangka", "Melon", "Pepaya", "Mangga", "Duku");
	$arrlength = count($fruits);
	echo "Panjang array saat ini : $arrlength<br><br>";
	for ($x=0; $x < $arrlength ; $x++) { 
		echo $fruits[$x];
		echo "<br>";
	}
?>