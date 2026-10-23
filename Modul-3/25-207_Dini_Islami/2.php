<?php 
// 2.1 
$fruits = array("Avocado", "Blueberry", "Cherry");
$buahBaru = array("Durian", "Elderberry", "Fig", "Grape", "Mango");

for ($x = 0; $x < count($buahBaru); $x++) {
    $fruits[] = $buahBaru[$x];
}
$arrlength = count($fruits);
echo "Panjang array fruits: " . $arrlength . "<br>";
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

// 2.2
$vegies = array("Carrot", "Spinach", "Broccoli");
$arrlength = count($vegies);
echo "Panjang array vegies: " . $arrlength . "<br>";
for ($x = 0; $x < $arrlength; $x++) {
    echo $vegies[$x] . "<br>";
}

?>