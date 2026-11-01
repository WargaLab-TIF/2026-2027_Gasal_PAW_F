<?php
    // Soal 2.1
    $fruits = array("Avocado", "Blueberry", "Cherry");
    $buah_tambahan = array(
        "Buah Tambahan 1",
        "Buah Tambahan 2",
        "Buah Tambahan 3",
        "Buah Tambahan 4",
        "Buah Tambahan 5"
    );

    for ($i = 0; $i < count($buah_tambahan); $i++) {
        $fruits[] = $buah_tambahan[$i];
    }

    $arrlength = count($fruits);

    echo "Panjang array saat ini: " . $arrlength . "<br><br>";

    for ($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x] . "<br>";
    }

    echo "<br>";

    // Soal 2.2
    $vegies = array("Carrot", "Broccoli", "Spinach");

    $arrlength = count($vegies);

    for ($i = 0; $i < $arrlength; $i++) {
        echo $vegies[$i] . "<br>";
    }
?>