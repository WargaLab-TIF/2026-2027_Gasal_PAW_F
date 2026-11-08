<?php
// Soal 1
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM","PAW"];
echo "<b>Jawaban Soal 1 :</b><br>";
foreach($matkul as $key => $value){
    if ($value === $praktikum[0] || $value === $praktikum[1]){
        echo "Saya sedang mengambil matkul $value termasuk praktikum-nya <br>";
        echo "<br>";
    }elseif($key==6 || $key==7){
        echo "Saya belum mengambil matkul $value <br>";
        echo "<br>";
        }else{
            echo "Saya sudah mengambil matkul $value semester lalu <br>";
            echo "<br>";
        }
}
?>