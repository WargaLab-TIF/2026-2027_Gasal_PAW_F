<?php
// 1. array_push()
$buah = array("A");
echo 'Array awal: ("' . implode('", "', $buah) . '")<br>';

array_push($buah, "B");
echo "Hasil array_push: " . implode(" ", $buah);
echo "<br><br>";

// 2. array_merge()
$buah = array("A", "B");
$buah2 = array("C");
echo 'Array awal: ("' . implode('", "', $buah) . '") digabung dengan ("' . implode('", "', $buah2) . '")<br>';

$hasil = array_merge($buah, $buah2);
echo "Hasil array_merge: " . implode(" ", $hasil);
echo "<br><br>";

// 3. array_values()
$data = array("x" => 1, "y" => 2);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';

$hasil = array_values($data);
echo "Hasil array_values: " . implode(", ", $hasil);
echo "<br><br>";

// 4. array_search()
$buah = array("A", "B", "C");
echo 'Mencari "B" pada array: ("' . implode('", "', $buah) . '")<br>';

$hasil = array_search("B", $buah);
echo "Hasil array_search: " . $hasil;
echo "<br><br>";

// 5. array_filter()
$angka = array(0, 1, false, 2, "", 3, "array");
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';

$hasil = array_filter($angka);
echo "Hasil array_filter: " . implode(" ", $hasil);
echo "<br><br>";

// 6. sort() dan rsort()
$angka = array(3, 1, 2);
echo "Array awal: (" . implode(", ", $angka) . ")<br>";

sort($angka);
echo "Hasil sort: " . implode(" ", $angka) . "<br>";

rsort($angka);
echo "Hasil rsort: " . implode(" ", $angka);
echo "<br><br>";

// 7. Sorting array asosiatif
$nilai = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

asort($nilai);
echo "Hasil asort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . "=> " . $umur . ", ";
}
echo "<br>";

ksort($nilai);
echo "Hasil ksort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . "=> " . $umur . ", ";
}
echo "<br>";

arsort($nilai);
echo "Hasil arsort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . "=> " . $umur . ", ";
}
echo "<br>";

krsort($nilai);
echo "Hasil krsort: ";
foreach ($nilai as $nama => $umur) {
    echo $nama . "=> " . $umur . ", ";
}
?>