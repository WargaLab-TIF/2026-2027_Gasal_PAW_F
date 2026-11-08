<?php 
// 2.1
$fruits=["Avocado","Blueberry","Cherry"];
for($x=1;$x<=5;$x++){
	array_push($fruits, "Buah Tambahan ".$x);
}

echo "Panjang array saat ini: ".count($fruits)."<br>"."<br>";
$arrlength=count($fruits);
for($x=0;$x<$arrlength;$x++){
	echo $fruits[$x];
	echo "<br>";
}
echo "<br>";
echo "<br>";

// 2.2
$vegies=["Carrot","Brorccoli","Spinach"];
$arrlength=count($vegies);
for($x=0;$x<$arrlength;$x++){
	echo $vegies[$x];
	echo "<br>";
}
?>