<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

for($i=0; $i < count($matkul);$i++){
    for($j=0; $j < count($praktikum);$j++){
        if($i == 6 ||  $i == 7){
            echo "Saya belum mengambil matkul $matkul[$i] <br>";
            break; // break agar tidak melakukan perulangan dua kali
        }
        elseif($matkul[$i] == $praktikum[$j]){
            echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya <br>";
        }else{
            echo "Saya sudah mengambil matkul $matkul[$i] semester lalu <br>";
            break; // break agar tidak melakukan perulangan dua kali
        }
        // echo $matkul[$i] , $praktikum[$j] . "<br>";

    }
}

?>