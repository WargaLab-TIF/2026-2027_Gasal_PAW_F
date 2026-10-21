<?php

// 1. array_push()
$fruit = array("A");

echo 'Array awal: ("' . implode('", "', $fruit) . '")<br>';
array_push($fruit, "B");
echo "Hasil array_push: " . implode(" ", $fruit) . "<br><br>";


// 2. array_merge()
$fruit1 = array("A", "B");
$fruit2 = array("C");

echo 'Array awal: ("' . implode('", "', $fruit1) . '") digabung dengan ("'
    . implode('", "', $fruit2) . '")<br>';

$gabungan = array_merge($fruit1, $fruit2);

echo "Hasil array_merge: " . implode(" ", $gabungan) . "<br><br>";


// 3. array_values()
$angka = array("x" => 1, "y" => 2);

echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$nilai = array_values($angka);
echo "Hasil array_values: " . implode(" ", $nilai) . "<br><br>";


// 4. array_search()
$fruit = array("A", "B", "C");

echo 'Mencari "B" pada array: ("' . implode('", "', $fruit) . '")<br>';
$cari = array_search("B", $fruit);
echo "Hasil array_search: " . $cari . "<br><br>";


// 5. array_filter()
$data = array(0, 1, false, 2, "", 3, "array");

echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
$filter = array_filter($data);
echo "Hasil array_filter: " . implode(" ", $filter) . "<br><br>";


// 6. Sorting array terindeks
$angka = array(3, 1, 2);

echo "Array awal: (" . implode(", ", $angka) . ")<br>";

sort($angka);
echo "Hasil sort: " . implode(" ", $angka) . "<br>";

rsort($angka);
echo "Hasil rsort: " . implode(" ", $angka) . "<br><br>";


// 7. Sorting array asosiatif
$orang = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

function tampilkanArray($data1) {
    $hasil = array();

    foreach ($data1 as $key => $value) {
        $hasil[] = $key . "=> " . $value;
    }

    return implode(", ", $hasil);
}

echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';
asort($orang);
echo "Hasil asort: " . tampilkanArray($orang) . "<br>";

ksort($orang);
echo "Hasil ksort: " . tampilkanArray($orang) . "<br>";

arsort($orang);
echo "Hasil arsort: " . tampilkanArray($orang) . "<br>";

krsort($orang);
echo "Hasil krsort: " . tampilkanArray($orang) . "<br>";

?>
