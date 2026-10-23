<?php  
// 1. array_push()
$buah = array("Apel", "Mangga", "Jeruk");
array_push($buah, "Pisang", "Anggur");
echo "array_push: <br>";
print_r($buah);

// 2. array_merge()
$buah1 = array("Apel", "Mangga");
$buah2 = array("Jeruk", "Pisang");
$gabungan = array_merge($buah1, $buah2);
echo "<br>array_merge: <br>";
print_r($gabungan);

// 3. array_values()
$nim = array(
    "Dini" => "207",
    "Kika" => "047",
    "Agustin" => "051"
);
$nilai = array_values($nim);
echo "<br>array_values: <br>";
print_r($nilai);

// 4. array_search()
$buah = array("Apel", "Mangga", "Jeruk", "Pisang");
$cari = array_search("Jeruk", $buah);
echo "<br>array_search: <br>";
echo "hasil array_search: " . $cari;

// 5. array_filter()
$angka = array(10, 15, 20, 25, 30);
$hasilFilter = array_filter($angka, function($nilai) {
    return $nilai > 20;
});
echo "<br>array_filter: <br>";
print_r($hasilFilter);

//sorting
$angka = array(40, 10, 30, 20);
sort($angka);
echo "<br><br>sort(): ";
print_r($angka);

rsort($angka);
echo "<br>rsort(): ";
print_r($angka);

$tinggi = array(
    "Dini" => "157",
    "Kika" => "155",
    "Agustin" => "160"
);

asort($tinggi);
echo "<br>asort(): ";
print_r($tinggi);

arsort($tinggi);
echo "<br>arsort(): ";
print_r($tinggi);

$tinggi = array(
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
);
ksort($tinggi);
echo "<br>ksort(): ";
print_r($tinggi);

krsort($tinggi);
echo "<br>krsort(): ";
print_r($tinggi);

?>