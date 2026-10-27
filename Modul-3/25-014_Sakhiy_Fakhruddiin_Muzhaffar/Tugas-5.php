<?php
$student = [
    ["Alex", "220401", "0812345678"],
    ["Bianca", "220402", "0812345687"],
    ["Candice", "220403", "0812345665"]
];

echo "Data awal:<br>";
echo "students = (<br>";
foreach ($student as $baris) {
    echo '("' . $baris[0] . '", "' . $baris[1] . '", "' . $baris[2] . '")<br>';
}
echo ")<br>";

$student[] = ["Daniel", "220404", "0812345611"];
$student[] = ["Elena", "220405", "0812345622"];
$student[] = ["Fiona", "220406", "0812345633"];
$student[] = ["Gabe", "220407", "0812345644"];
$student[] = ["Hannah", "220408", "0812345655"];

echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (<br>";
foreach ($student as $baris) {
    echo '("' . $baris[0] . '", "' . $baris[1] . '", "' . $baris[2] . '")<br>';
}
echo ")<br><br>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tugas Array Multidimensi</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Name</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
        
        <?php foreach ($student as $baris): ?>
            <tr>
                <td><?= $baris[0] ?></td> 
                <td><?= $baris[1] ?></td> 
                <td><?= $baris[2] ?></td> 
            </tr>
        <?php endforeach; ?>
        
    </table>

</body>
</html>