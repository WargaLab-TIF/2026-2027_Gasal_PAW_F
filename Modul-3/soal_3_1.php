<?php
// Soal 3.1 

function teksAsosiatif($nama, $arr) {
    $items = array();
    foreach ($arr as $key => $value) {
        $items[] = "\"" . $key . "\"=&gt;\"" . $value . "\"";
    }
    return $nama . " = (" . implode(", ", $items) . ")";
}

$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

// Menambahkan lima data baru
$height["David"]  = "180";
$height["Ethan"]  = "172";
$height["Frank"]  = "168";
$height["George"] = "175";
$height["Harry"]  = "182";

echo teksAsosiatif("height", $height) . "<br>";
$kunciTerakhir = array_key_last($height);
echo "Nilai dengan indeks terakhir: " . $height[$kunciTerakhir] . "<br><br>";

// Menghapus satu data tertentu (Barry)
unset($height["Barry"]);

echo teksAsosiatif("height", $height) . "<br>";
$kunciTerakhir = array_key_last($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height[$kunciTerakhir];
?>
