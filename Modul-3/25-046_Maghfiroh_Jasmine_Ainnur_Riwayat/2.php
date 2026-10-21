<?php
//2.1
$fruits = ["Avocado", "Blueberry", "Cherry"];
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah tambahan $i";
}

echo "Panjang array saat ini : " . count($fruits) . "<br><br>";

$arrlength = count($fruits);
for ($j = 0; $j < $arrlength; $j++) {
    echo $fruits[$j] . "<br>";
}

echo "<br>";

//2.2
$sayur = ["Carrot", "Broccoli", "Spinach"];
$arrlength = count($sayur);
for ($j = 0; $j < $arrlength; $j++) {
    echo $sayur[$j] . "<br>";
}
?>