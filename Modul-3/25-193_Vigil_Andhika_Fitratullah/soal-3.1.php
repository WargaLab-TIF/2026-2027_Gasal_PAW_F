<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height["David"]  = "180";
$height["Ethan"]  = "172";
$height["Frank"]  = "168";
$height["George"] = "175";
$height["Harry"]  = "182";

$pasangan = [];
foreach ($height as $key => $value) {
    $pasangan[] = "\"$key\"=>\"$value\"";
}
echo "height = (" . implode(", ", $pasangan) . ")<br>";
echo "Nilai dengan indeks terakhir: " . end($height) . "<br><br>";

unset($height["Barry"]);

$pasangan = [];
foreach ($height as $key => $value) {
    $pasangan[] = "\"$key\"=>\"$value\"";
}
echo "height = (" . implode(", ", $pasangan) . ")<br>";
echo "Nilai dengan indeks terakhir setelah dihapus: " . end($height);
?>