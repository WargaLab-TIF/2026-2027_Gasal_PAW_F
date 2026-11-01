<?php
$students = [
    ["Alex", "220401", "0812345678"],
    ["Bianca", "220402", "0812345687"],
    ["Candice", "220403", "0812345665"]
];

echo "Data awal:<br>";
echo "students = (<br>";

foreach ($students as $student) {
    echo "(\"$student[0]\", \"$student[1]\", \"$student[2]\")<br>";
}

echo ")<br><br>";

$students[] = ["Daniel", "220404", "0812345611"];
$students[] = ["Elena", "220405", "0812345622"];
$students[] = ["Fiona", "220406", "0812345633"];
$students[] = ["Gabe", "220407", "0812345644"];
$students[] = ["Hannah", "220408", "0812345655"];

echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (<br>";

foreach ($students as $student) {
    echo "(\"$student[0]\", \"$student[1]\", \"$student[2]\")<br>";
}

echo ")<br><br>";

echo "<table border='1' cellpadding='5' cellspacing='0'>";

echo "<tr>
        <th>Name</th>
        <th>NIM</th>
        <th>Mobile</th>
      </tr>";

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>{$student[0]}</td>";
    echo "<td>{$student[1]}</td>";
    echo "<td>{$student[2]}</td>";
    echo "</tr>";
}

echo "</table>";
?>