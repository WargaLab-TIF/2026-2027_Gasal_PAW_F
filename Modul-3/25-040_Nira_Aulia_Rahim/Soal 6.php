<?php
// 1. Fungsi array_push()
$daftar_buah = ["A"];
echo 'Array awal: ("' . implode('", "', $daftar_buah) . '")<br>';

array_push($daftar_buah, "B");

echo "Hasil array_push: ";
foreach ($daftar_buah as $buah) {
    echo $buah . " ";
}

echo "<br><br>";

// 2. Fungsi array_merge()
$array_pertama = ["A", "B"];
$array_kedua = ["C"];
echo 'Array awal: ("' . implode('", "', $array_pertama) . '") digabung dengan ("' . implode('", "', $array_kedua) . '")<br>';

$array_gabungan = array_merge($array_pertama, $array_kedua);

echo "Hasil array_merge: ";
foreach ($array_gabungan as $item) {
    echo $item . " ";
}

echo "<br><br>";

// 3. Fungsi array_values()
$data_nilai = ["x" => 1, "y" => 2];
$format_nilai = [];
foreach ($data_nilai as $kunci => $nilai) {
    $format_nilai[] = '"' . $kunci . '" => ' . $nilai;
}
echo 'Array awal: (' . implode(', ', $format_nilai) . ')<br>';

$nilai_saja = array_values($data_nilai);

echo "Hasil array_values: ";
foreach ($nilai_saja as $nilai) {
    echo $nilai . " ";
}

echo "<br><br>";

// 4. Fungsi array_search()
$daftar_huruf = ["A", "B", "C"];
echo 'Mencari "B" pada array: ("' . implode('", "', $daftar_huruf) . '")<br>';

$posisi_index = array_search("B", $daftar_huruf);

echo "Hasil array_search: " . $posisi_index;

echo "<br><br>";

// 5. Fungsi array_filter()
$campuran_data = [0, 1, false, 2, "", 3, "array"];
$format_data = [];
foreach ($campuran_data as $elemen) {
    if (is_bool($elemen)) {
        $format_data[] = $elemen ? 'true' : 'false';
    } elseif (is_string($elemen)) {
        $format_data[] = $elemen === "" ? '""' : '"' . $elemen . '"';
    } else {
        $format_data[] = $elemen;
    }
}
echo 'Array awal: (' . implode(', ', $format_data) . ')<br>';

$hasil_filter = array_filter($campuran_data);

echo "Hasil array_filter: ";
foreach ($hasil_filter as $elemen) {
    echo $elemen . " ";
}

echo "<br><br>";

// 6. Fungsi sort()
$daftar_angka = [3, 1, 2];
echo "Array awal: (" . implode(', ', $daftar_angka) . ")<br>";

sort($daftar_angka);

echo "Hasil sort: ";
foreach ($daftar_angka as $angka) {
    echo $angka;
}

echo "<br>";

// 7. Fungsi rsort()
$daftar_angka = [3, 1, 2];
rsort($daftar_angka);

echo "Hasil rsort: ";
foreach ($daftar_angka as $angka) {
    echo $angka;
}

echo "<br><br>";

$data_umur = [
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
];

$format_umur = [];
foreach ($data_umur as $nama => $usia) {
    $format_umur[] = '"' . $nama . '"=>' . $usia;
}
echo 'Array awal: (' . implode(', ', $format_umur) . ')<br>';

// 8. Fungsi asort()
$umur_di_asort = $data_umur;
asort($umur_di_asort);
echo "Hasil asort: ";
$total_data = count($umur_di_asort);
$index = 0;
foreach ($umur_di_asort as $nama => $usia) {
    $index++;
    $pemisah = ($index == 1) ? "-> " : "=> ";
    $tanda_koma = ($index < $total_data) ? ", " : ",";
    echo "$nama$pemisah$usia$tanda_koma";
}
echo "<br>";

// 9. Fungsi ksort()
$umur_di_ksort = $data_umur;
ksort($umur_di_ksort);
echo "Hasil ksort: ";
$total_data = count($umur_di_ksort);
$index = 0;
foreach ($umur_di_ksort as $nama => $usia) {
    $index++;
    $tanda_koma = ($index < $total_data) ? ", " : ",";
    echo "$nama=> $usia$tanda_koma";
}
echo "<br>";

// 10. Fungsi arsort()
$umur_di_arsort = $data_umur;
arsort($umur_di_arsort);
echo "Hasil arsort: ";
$total_data = count($umur_di_arsort);
$index = 0;
foreach ($umur_di_arsort as $nama => $usia) {
    $index++;
    $pemisah = ($nama === "Peter") ? "-> " : "=> ";
    $tanda_koma = ($index < $total_data) ? ", " : ",";
    echo "$nama$pemisah$usia$tanda_koma";
}
echo "<br>";

// 11. Fungsi krsort()
$umur_di_krsort = $data_umur;
krsort($umur_di_krsort);
echo "Hasil krsort: ";
$total_data = count($umur_di_krsort);
$index = 0;
foreach ($umur_di_krsort as $nama => $usia) {
    $index++;
    $tanda_koma = ($index < $total_data) ? ", " : ",";
    echo "$nama-> $usia$tanda_koma";
}
?>