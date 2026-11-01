<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = ";
print_r($height);
echo "<br>";

$keys = array_keys($height);
echo "Nilai dengan indeks terakhir: " . $height[end($keys)] . "<br><br>";

unset($height["Barry"]);

echo "height = ";
print_r($height);
echo "<br>";

$keys_deleted = array_keys($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height[end($keys_deleted)];
?>