<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i; 
}

$panjang = count($fruits);
echo "Panjang array saat ini: " . $panjang;
echo "<br><br>";

for($x = 0; $x < $panjang; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "<br><br>";

$vegies = array("Carrot", "Broccoli", "Spinach");
$arrlength_vegies = count($vegies);

for($x = 0; $x < $arrlength_vegies; $x++) {
    echo $vegies[$x];
    echo "<br>";
}
?>