<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM","PAW"];
for($i = 0; $i < count($matkul); $i++){
  $ada = false;
  for($j = 0; $j < count($praktikum); $j++){
    if($matkul[$i] == $praktikum[$j]){
      $ada = true;
    }
  }
  if($ada){
    echo "Saya sedang mengambil matkul {$matkul[$i]} termasuk praktikumnya <br>";
  }elseif($i == 6 || $i == 7){
    echo "Saya belum mengambil matkul {$matkul[$i]} <br>";
  }else{
    echo "Saya sudah mengambil matkul {$matkul[$i]} semester lalu <br>";
  }
}
?>