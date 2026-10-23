<?php
// 3.1
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height= ";
print_r($height);
echo "<br>Nilai dengan indeks terakhir: ". end($height). '<br>';

unset($height["Barry"]);
echo "<br> height= ";
print_r($height);
echo "<br>Nilai dengan indeks terakhir setelah dihapus: ". end($height). '<br>';

// 3.2
$weight = array(
    "Andy" => "60",
    "Barry" => "55",
    "Charlie" => "65"
);

echo "<br> weight= ";
print_r($weight);
$data = array_values($weight);
echo "<br>Data kedua: " . $data[1];
?>