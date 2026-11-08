<?php

$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andy is ".$height['Andy']." cm tall";

echo "<br><br>";

// 3.1
$nama = ["David", "Ethan", "Frank", "George", "Harry"];
$tinggi = ["180", "172", "168", "175", "182"];

for ($i = 0; $i < count($nama); $i++) {
    $height[$nama[$i]] = $tinggi[$i];
}

function tampil($arr) {
    $i = 0;

    foreach ($arr as $key => $val) {
        echo '"' . $key . '" => "' . $val . '"';

        if ($i != count($arr) - 1) {
            echo ", ";
        }

        $i++;
    }
}

echo '$height = (';
tampil($height);

$lastHeight = end($height);
echo ") <br>Nilai dengan Indeks terakhir: " . $lastHeight;
echo "<br><br>";

unset($height["Barry"]);

echo '$height = (';
tampil($height);

$lastHeight = end($height);
echo ") <br>Nilai dengan Indeks terakhir: " . $lastHeight;
echo "<br><br>";



//3.2
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
echo '$weight = (';
tampil($weight);

echo ") <br>Data kedua: " . array_values($weight)[1];

?>