<?php
$array = array("A");
echo 'Array awal: ("A")<br>';
array_push($array, "B");
echo "Hasil array_push: " . implode(" ", $array) . "<br><br>";


$array1 = array("A", "B");
$array2 = array("C");
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$hasil = array_merge($array1, $array2);
echo "Hasil array_merge: " . implode(" ", $hasil) . "<br><br>";


$array = array("x" => 1, "y" => 2);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$hasil = array_values($array);
echo "Hasil array_values: " . implode(" ", $hasil) . "<br><br>";


$array = array("A", "B", "C");
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
$hasil = array_search("B", $array);
echo "Hasil array_search: " . $hasil . "<br><br>";

$array = array(0, 1, false, 2, "", 3, "array");
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
$hasil = array_filter($array);
echo "Hasil array_filter: " . implode(" ", $hasil) . "<br><br>";

$array = array(3, 1, 2);
echo 'Array awal: (3, 1, 2)<br>';
$sort = $array;
sort($sort);
echo "Hasil sort: " . implode(" ", $sort) . "<br>";

$rsort = $array;
rsort($rsort);
echo "Hasil rsort: " . implode(" ", $rsort) . "<br><br>";

$nilai = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

$data = $nilai;
asort($data);
echo "Hasil asort: ";
foreach ($data as $nama => $angka) {
    echo "$nama => $angka, ";
}
echo "<br>";

$data = $nilai;
ksort($data);
echo "Hasil ksort: ";
foreach ($data as $nama => $angka) {
    echo "$nama => $angka, ";
}
echo "<br>";

$data = $nilai;
arsort($data);
echo "Hasil arsort: ";
foreach ($data as $nama => $angka) {
    echo "$nama => $angka, ";
}
echo "<br>";

$data = $nilai;
krsort($data);
echo "Hasil krsort: ";
foreach ($data as $nama => $angka) {
    echo "$nama => $angka, ";
}
echo "<br>";

?>