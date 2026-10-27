<?php
$height = [
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170",
];

$data_tambahan = [
    "David" => "180",
    "Ethan" => "172",
    "Frank" => "168",
    "George" => "175",
    "Harry" => "182",
];
$height = array_merge($height, $data_tambahan);

var_dump($height);
echo "<br>";
echo "Nilai dengan indeks terakhir: " . $height["Harry"];
echo "<br><br>";

unset($height["Barry"]);
var_dump($height);
echo "<br>";
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height["Harry"];
echo "<br><br>";


$weight = [
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75",
];

var_dump($weight);
echo "<br>";
echo "Data kedua: " . $weight["Barry"];
?>