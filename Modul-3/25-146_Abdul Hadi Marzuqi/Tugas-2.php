<?php
// Jawaban 2.1
echo "<b>Jawaban 2.1</b>";
echo "<br>";

$fruits = array("Avocado","Blueberry","Cherry");

for($x = 1; $x <=5; $x++) {
    array_push($fruits,"Buah Tambahan ".$x);
}
$panjang_arr = count($fruits);
echo "Panjang array saat ini : ".$panjang_arr;
echo "<br>";
echo "<br>";

for ($i=0; $i<$panjang_arr; $i++){
    echo $fruits[$i];
    echo "<br>";
}

echo "<br>";

// Jawaban 2.2
echo "<b>Jawaban 2.2</b>";
echo "<br>";

$vegies = ["Carrot","Broccoli","Spinach"];
$panjang_arr = count($vegies);
for ($i = 0; $i < $panjang_arr; $i++){
    echo $vegies[$i];
    echo "<br>";
}
?>