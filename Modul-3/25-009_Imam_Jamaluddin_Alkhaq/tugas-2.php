<?php
$fruits = array("Avocado","Blueberry","Cherry");

for($x = 0; $x < 5; $x++) {
	array_push($fruits,"Buah Tambahan ".$x+1);
}


$arrlength = count($fruits);
echo "Panjang array saat ini: ".$arrlength. "<br><br>";
for($x = 0; $x < $arrlength; $x++) {
	echo $fruits[$x];
	echo "<br>";
}
echo "<br><br>";

$vegies = array("Carrot","Broccoli","Spinach");
$arrlength2 = count($vegies);
for($x = 0; $x < $arrlength2; $x++) {
	echo $vegies[$x];
	echo "<br>";
}
 ?>