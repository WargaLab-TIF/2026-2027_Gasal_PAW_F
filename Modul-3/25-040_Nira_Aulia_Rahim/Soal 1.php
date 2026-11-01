<?php
    // Soal 1.1
    $fruits = array("Avocado", "Blueberry", "Cherry");
    array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");
    echo 'fruits = ("' . implode('", "', $fruits) . '")';
    echo "<br>";
    echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];

    echo "<br><br>";

    // Soal 1.2
    $fruits = array("Avocado", "Blueberry", "Cherry");
    array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");
    unset($fruits[1]);
    $fruits = array_values($fruits);
    echo "Data Blueberry dihapus.<br>";
    echo 'fruits = ("' . implode('", "', $fruits) . '")';
    echo "<br>";
    echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];
?>
