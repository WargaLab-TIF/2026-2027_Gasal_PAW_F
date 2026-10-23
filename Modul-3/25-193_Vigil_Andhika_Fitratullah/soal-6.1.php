<?php
$a = ["A"];
array_push($a, "B");
echo 'Array awal: ("A")<br>';
echo "Hasil array_push: " . implode(" ", $a) . "<br><br>";

$b1 = ["A", "B"];
$b2 = ["C"];
$gabung = array_merge($b1, $b2);
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
echo "Hasil array_merge: " . implode(" ", $gabung) . "<br><br>";

$c = ["x" => 1, "y" => 2];
$nilai = array_values($c);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
echo "Hasil array_values: " . implode(" ", $nilai) . "<br><br>";

$d = ["A", "B", "C"];
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
echo "Hasil array_search: " . array_search("B", $d) . "<br><br>";

$e = [0, 1, false, 2, "", 3, "array"];
$saring = array_filter($e);
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
echo "Hasil array_filter: " . implode(" ", $saring) . "<br><br>";

$f = [3, 1, 2];
echo "Array awal: (3, 1, 2)<br>";
sort($f);
echo "Hasil sort: " . implode(" ", $f) . "<br>";
rsort($f);
echo "Hasil rsort: " . implode(" ", $f) . "<br><br>";

$g = ["Peter" => 35, "Ben" => 37, "Joe" => 43];
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

asort($g);
echo "Hasil asort: ";
foreach ($g as $k => $v) {
  echo $k . "=> " . $v . ", ";
}
echo "<br>";

ksort($g);
echo "Hasil ksort: ";
foreach ($g as $k => $v) {
  echo $k . "=> " . $v . ", ";
}
echo "<br>";

arsort($g);
echo "Hasil arsort: ";
foreach ($g as $k => $v) {
  echo $k . "=> " . $v . ", ";
}
echo "<br>";

krsort($g);
echo "Hasil krsort: ";
foreach ($g as $k => $v) {
  echo $k . "=> " . $v . ", ";
}
echo "<br>";

?>