<?php
$arr1 = array("A");
echo "Array awal: (\"" . implode('", "', $arr1) . "\")<br>";
array_push($arr1, "B");
echo "Hasil array_push: " . implode(' ', $arr1) . "<br><br>";

$arr2_a = array("A", "B");
$arr2_b = array("C");
echo "Array awal: (\"" . implode('", "', $arr2_a) . "\") digabungkan dengan (\"" . implode('", "', $arr2_b) . "\")<br>";
$result_merge = array_merge($arr2_a, $arr2_b);
echo "Hasil array_merge: " . implode(' ', $result_merge) . "<br><br>";

$arr3 = array("x" => 1, "y" => 2);
echo "Array awal: (\"x\" => 1, \"y\" => 2)<br>";
$result_values = array_values($arr3);
echo "Hasil array_values: " . implode(' ', $result_values) . "<br><br>";

$arr4 = array("A", "B", "C");
echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";
$index = array_search("B", $arr4);
echo "Hasil array_search: " . $index . "<br><br>";

$arr5 = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";
$result_filter = array_filter($arr5);
echo "Hasil array_filter: " . implode(' ', $result_filter) . "<br><br>";

$arr6 = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
$arr_sort = $arr6;
sort($arr_sort);
echo "Hasil sort: " . implode(' ', $arr_sort) . "<br>";
$arr_rsort = $arr6;
rsort($arr_rsort);
echo "Hasil rsort: " . implode(' ', $arr_rsort) . "<br><br>";

$arr7 = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

$arr_asort = $arr7;
asort($arr_asort);
echo "Hasil asort: ";
$parts = array();
foreach($arr_asort as $k => $v) { $parts[] = "$k=> $v"; }
echo implode(', ', $parts) . ",<br>";

$arr_ksort = $arr7;
ksort($arr_ksort);
echo "Hasil ksort: ";
$parts = array();
foreach($arr_ksort as $k => $v) { $parts[] = "$k=> $v"; }
echo implode(', ', $parts) . ",<br>";

$arr_arsort = $arr7;
arsort($arr_arsort);
echo "Hasil arsort: ";
$parts = array();
foreach($arr_arsort as $k => $v) { $parts[] = "$k=> $v"; }
echo implode(', ', $parts) . ",<br>";

$arr_krsort = $arr7;
krsort($arr_krsort);
echo "Hasil krsort: ";
$parts = array();
foreach($arr_krsort as $k => $v) { $parts[] = "$k=> $v"; }
echo implode(', ', $parts) . ",";
?>