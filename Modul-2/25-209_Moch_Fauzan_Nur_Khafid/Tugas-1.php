<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT",
            "JARKOM","PAW","PSBF","RPL"];

$praktikum = ["JARKOM", "PAW"];

foreach($matkul as $key => $value ){
    if($value === $praktikum[0] || $value === $praktikum[1]){
        echo "Saya sedang mengambil matkul $value termasuk praktikum nya <br>";
    }elseif($key === 6 || $key === 7){
        echo "saya belum mengambil mengambil matkul $value <br>";
    }else{
        echo "Saya sudah mengambil matkul $value semester lalu<br>";
    }
}

?>