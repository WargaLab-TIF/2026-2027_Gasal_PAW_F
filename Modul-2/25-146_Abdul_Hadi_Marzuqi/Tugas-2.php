<?php
// Soal 2
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
echo "<b>Jawaban Soal 2 :</b><br>";
foreach($matkul as $key => $value){
    switch($value){
        case "PTI":
            echo "Saya suka $value<br>";
            echo "<br>";
            break;
        case "ALPRO":
            echo "Saya suka $value<br>";
            echo "<br>";
            break;
        case "DPW":
            echo "Saya suka $value<br>";
            echo "<br>";
            break;
        case "STRUKDAT":
            echo "Saya suka $value<br>";
            echo "<br>";
            break;
        case "JARKOM":
            echo "Saya suka $value<br>";
            echo "<br>";
            break;
        case "PAW":
            echo "Saya suka $value<br>";
            echo "<br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $value<br>";
            echo "<br>";
            break;
    }
}
?>