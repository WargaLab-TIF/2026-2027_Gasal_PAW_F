<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
$kunci  = array_keys($weight);
$pasang = [];
for($i = 0; $i < count($kunci); $i++){
  $pasang[]= '"'.$kunci[$i].'"=>"'. $weight[$kunci[$i]]. '"';
}
echo "weight = (" . implode(", ", $pasang) . ")<br><br>";

for($i = 0; $i < count($weight); $i++){
  echo $kunci[$i] . ' is '. $weight[$kunci[$i]]. ' kg.'. '<br>';
}
?>