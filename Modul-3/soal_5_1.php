<?php
// Soal 5.1 - Array multidimensi data mahasiswa

function teksStudents($students) {
    $hasil = "students = (<br>";
    $baris = array();
    foreach ($students as $s) {
        $baris[] = "(\"" . $s[0] . "\", \"" . $s[1] . "\", \"" . $s[2] . "\")";
    }
    $hasil .= implode(",<br>", $baris);
    $hasil .= "<br>)";
    return $hasil;
}

$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
echo teksStudents($students) . "<br><br>";

$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena", "220405", "0812345622");
$students[] = array("Fiona", "220406", "0812345633");
$students[] = array("Gabe", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

echo "Data setelah ditambah 5 data lain:<br>";
echo teksStudents($students) . "<br><br>";

echo "<table border='1' cellpadding='3'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach ($students as $s) {
    echo "<tr>";
    echo "<td>" . $s[0] . "</td>";
    echo "<td>" . $s[1] . "</td>";
    echo "<td>" . $s[2] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
