<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

foreach ($matkul as $namaMatkul) {

    switch ($namaMatkul) {

        case "PTI":
            $pesan = "Saya suka PTI";
            break;

        case "ALPRO":
            $pesan = "Saya suka ALPRO";
            break;

        case "DPW":
            $pesan = "Saya suka DPW";
            break;

        case "STRUKDAT":
            $pesan = "Saya suka STRUKDAT";
            break;

        case "JARKOM":
            $pesan = "Saya suka JARKOM";
            break;

        case "PAW":
            $pesan = "Saya suka PAW";
            break;

        default:
            $pesan = "Saya tidak mengambil matkul " . $namaMatkul;
            break;
    }

    echo $pesan . "<br>";
}

?>