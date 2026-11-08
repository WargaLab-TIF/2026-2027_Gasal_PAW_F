<?php
$matkul=["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum=["JARKOM","PAW"];

$i=0;
foreach($matkul as $Matkul){
    $cek=false;
    foreach($praktikum as $Praktikum){
        if($Matkul == $Praktikum){
            $cek=True;
        }
    }
    if($cek==True){
        echo "Saya sedang mengambil matkul ".$Matkul." termasuk praktikumnya."."<br>";
    }elseif($i==7 || $i==6){
        echo "Saya belum mengambil matkul ".$Matkul."<br>";
    }else{
        echo "Saya sudah mengambil matkul ".$Matkul." semester lalu."."<br>";
    }
    $i++;
}
?>