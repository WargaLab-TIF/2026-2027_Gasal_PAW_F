<?php
$a = array("A");
array_push($a, "B");
echo 'Array awal: ("A")<br>';
echo "Hasil array_push: " . implode(" ", $a) . "<br><br>";

$a1 = array("A", "B");
$a2 = array("C");
$merged = array_merge($a1, $a2);
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
echo "Hasil array_merge: " . implode(" ", $merged) . "<br><br>";

$assoc = array("x" => 1, "y" => 2);
$val = array_values($assoc);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
echo "Hasil array_values: " . implode(" ", $val) . "<br><br>";

$search_arr = array("A", "B", "C");
$found = array_search("B", $search_arr);
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
echo "Hasil array_search: " . $found . "<br><br>";

$filter_arr = array(0, 1, false, 2, "", 3, "array");
$filtered = array_filter($filter_arr);
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
echo "Hasil array_filter: " . implode(" ", $filtered) . "<br><br>";

$num = array(3, 1, 2);
echo 'Array awal: (3, 1, 2)<br>';
$num_sort = $num;
sort($num_sort);
echo "Hasil sort: " . implode(" ", $num_sort) . "<br>";
$num_rsort = $num;
rsort($num_rsort);
echo "Hasil rsort: " . implode(" ", $num_rsort) . "<br><br>";

$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

$a_asort = $age;
asort($a_asort);
$out = array();
foreach($a_asort as $k => $v) { $out[] = "$k=> $v"; }
echo "Hasil asort: " . implode(", ", $out) . ",<br>";

$a_ksort = $age;
ksort($a_ksort);
$out = array();
foreach($a_ksort as $k => $v) { $out[] = "$k=> $v"; }
echo "Hasil ksort: " . implode(", ", $out) . ",<br>";

$a_arsort = $age;
arsort($a_arsort);
$out = array();
foreach($a_arsort as $k => $v) { $out[] = "$k=> $v"; }
echo "Hasil arsort: " . implode(", ", $out) . ",<br>";

$a_krsort = $age;
krsort($a_krsort);
$out = array();
foreach($a_krsort as $k => $v) { $out[] = "$k=> $v"; }
echo "Hasil krsort: " . implode(", ", $out) . ",<br>";
?>