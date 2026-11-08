<?php

$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo "weight = ( ";
$i = 0;
foreach ($weight as $nama => $berat) {
    if ($i > 0) {
        echo ", ";
    }
    echo "\"$nama\"=>\"$berat\"";
    $i++;
}
echo " )<br><br>";

$daftarNama = array("Andy", "Barry", "Charlie");
$jumlah = count($daftarNama);

for ($i = 0; $i < $jumlah; $i++) {
    echo $daftarNama[$i] . " is " . $weight[$daftarNama[$i]] . " kg.<br>";
}

?>
