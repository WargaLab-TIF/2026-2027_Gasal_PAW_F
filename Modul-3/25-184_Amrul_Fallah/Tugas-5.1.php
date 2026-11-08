<?php

$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

function tampilStudents($data) {
    echo "students = (<br>";
    $total = count($data);
    for ($i = 0; $i < $total; $i++) {
        echo "(\"" . $data[$i][0] . "\", \"" . $data[$i][1] . "\", \"" . $data[$i][2] . "\")";
        if ($i < $total - 1) {
            echo ",";
        }
        echo "<br>";
    }
    echo ")<br>";
}

echo "Data awal:<br>";
tampilStudents($students);

$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena", "220405", "0812345622");
$students[] = array("Fiona", "220406", "0812345633");
$students[] = array("Gabriel", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

echo "<br>Data setelah ditambah 5 data lain:<br>";
tampilStudents($students);

echo "<br>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach ($students as $mhs) {
    echo "<tr>";
    echo "<td>" . $mhs[0] . "</td>";
    echo "<td>" . $mhs[1] . "</td>";
    echo "<td>" . $mhs[2] . "</td>";
    echo "</tr>";
}
echo "</table>";

?>
