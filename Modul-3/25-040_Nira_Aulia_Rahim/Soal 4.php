<?php
    // Soal 4.1
    $height = array(
        "Andy" => "176",
        "Barry" => "165",
        "Charlie" => "170"
    );

    $height["David"] = "180";
    $height["Ethan"] = "172";
    $height["Frank"] = "168";
    $height["George"] = "175";
    $height["Harry"] = "182";

    $temp_height = [];
    foreach ($height as $nama => $tinggi) {
        $temp_height[] = '"' . $nama . '"=>"' . $tinggi . '"';
    }

    echo 'height = (' . implode(', ', $temp_height) . ')';
    echo "<br><br>";

    foreach ($height as $nama => $tinggi) {
        echo $nama . " is " . $tinggi . " cm tall.<br>";
    }

    echo "<br>";

    // Soal 4.2
    $weight = array(
        "Andy" => "70",
        "Barry" => "65",
        "Charlie" => "75"
    );

    $temp_weight = [];
    foreach ($weight as $nama => $berat) {
        $temp_weight[] = '"' . $nama . '"=>"' . $berat . '"';
    }

    echo 'weight = (' . implode(', ', $temp_weight) . ')';
    echo "<br><br>";

    $nama = array_keys($weight);
    $jumlah = count($weight);

    for ($i = 0; $i < $jumlah; $i++) {
        echo $nama[$i] . " is " . $weight[$nama[$i]] . " kg.<br>";
    }
?>