<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];

foreach ($matkul as $key => $nilai) {
    switch ($nilai){
        case "PTI":
            echo "Saya suka  $nilai<br>";
            break;
        case "ALPRO":
            echo "Saya suka  $nilai<br>";
            break;
        case "DPW":
            echo "Saya suka  $nilai<br>";
            break;
        case "STRUKDAT":
            echo "Saya suka  $nilai<br>";
            break;
        case "JARKOM":
            echo "Saya suka  $nilai<br>";
            break;
        case "PAW":
            echo "Saya suka  $nilai<br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $nilai<br>";
            break;
    }
}


?>