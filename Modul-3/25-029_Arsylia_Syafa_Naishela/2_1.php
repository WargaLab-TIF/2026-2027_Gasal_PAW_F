<?php
// 2.1
$fruits = array("Avocado", "Blueberry", "Cherry");

for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}

$arrlength = count($fruits);

echo "Panjang array saat ini: " . $arrlength;
echo "<br><br>";

for ($i = 0; $i < $arrlength; $i++) {
    echo $fruits[$i];
    echo "<br>";
}
echo "<br><br>";

// 2.2
$vegies = array("Carrot", "Broccoli", "Spinach");

for ($x = 0; $x < 3; $x++) {
    echo $vegies[$x];
    echo "<br>";
}
?>