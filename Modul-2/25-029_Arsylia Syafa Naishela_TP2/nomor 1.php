<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

for ($i = 0; $i < 8; $i++) {

    if ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
    } 
    elseif ($matkul[$i] == "JARKOM" || $matkul[$i] == "PAW") {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikum nya" . "<br>";
    } 
    else {
        echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu" . "<br>";
    }

}

?>