<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Andy is " . $height['Andy'] . " cm tall.<br><br>";

// 3.1
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175"; 
$height["Harry"] = "182";

echo "height = ";
print_r($height);
echo "<br>Nilai dengan indeks terakhir: " . end($height) . "<br><br>";

unset($height["Barry"]);

echo "height = ";
print_r($height);
echo "<br>Nilai dengan indeks terakhir setelah dihapus: " . end($height) . "<br><br>";

// 3.2
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");
echo "weight = ";
print_r($weight);
echo "<br>Data kedua: " . $weight["Barry"];
?>