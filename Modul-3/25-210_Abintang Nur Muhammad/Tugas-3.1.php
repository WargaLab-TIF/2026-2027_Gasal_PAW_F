<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

$output = array();
foreach ($height as $nama => $tinggi) {
    $output[] = '"' . $nama . '"=>"' . $tinggi . '"';
}
echo 'height = (' . implode(', ', $output) . ')<br>';
echo "Nilai dengan indeks terakhir: " . $height["Harry"] . "<br><br>";

unset($height["Barry"]);

$output_setelah_hapus = array();
foreach ($height as $nama => $tinggi) {
    $output_setelah_hapus[] = '"' . $nama . '"=>"' . $tinggi . '"';
}
echo 'height = (' . implode(', ', $output_setelah_hapus) . ')<br>';
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height["Harry"];
?>