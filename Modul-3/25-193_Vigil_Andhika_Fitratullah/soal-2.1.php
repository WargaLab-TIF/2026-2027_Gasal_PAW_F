<?php
$fruits = array("Avocado","Blueberry","Cherry");
$pjg_array = count($fruits);
for($i = 1; $i <= 5; $i++){
  $fruits[] = 'Buah Tambahan '.$i;
}
$pjg_array = count($fruits);
echo "Panjang array saat ini: $pjg_array" . '<br><br>';
for($x = 0; $x < $pjg_array; $x++){
  echo $fruits[$x] . '<br>';
}
?>