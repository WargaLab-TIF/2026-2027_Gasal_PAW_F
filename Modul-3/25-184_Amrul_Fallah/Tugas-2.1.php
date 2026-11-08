<?php

$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}

$arrlength = count($fruits);

echo "Panjang array saat ini: " . $arrlength . "<br><br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}

/*
PENJELASAN NYA:
TIDAK perlu diubah, hanya saja ditaruh di akhir
*/

?>
