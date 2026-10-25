<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = ( ";
$keys = array_keys($height);
$lastIndex = count($height) - 1;
foreach ($height as $key => $value) {
    echo '"' . $key . '"=>"' . $value . '"';
    if ($key !== array_key_last($height)) {
        echo ", ";
    }
}
echo ")<br>";
$lastValue = end($height);
echo "Nilai dengan indeks terakhir: " . $lastValue . "<br><br>";
unset($height["Barry"]);
echo "height = ( ";
foreach ($height as $key => $value) {
    echo '"' . $key . '"=>"' . $value . '"';
    if ($key !== array_key_last($height)) {
        echo ", ";
    }
}
echo ")<br>";
$lastValueAfter = end($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $lastValueAfter;
?>