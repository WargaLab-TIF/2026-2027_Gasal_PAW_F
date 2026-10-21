<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
echo "students = (<br>";
echo '("Alex", "220401", "0812345678"),<br>';
echo '("Bianca", "220402", "0812345687"),<br>';
echo '("Candice", "220403", "0812345665")<br>';
echo ")<br><br>";

array_push($students, array("Daniel", "220404", "0812345611"));
array_push($students, array("Elena", "220405", "0812345622"));
array_push($students, array("Fiona", "220406", "0812345633"));
array_push($students, array("Gabe", "220407", "0812345644"));
array_push($students, array("Hannah", "220408", "0812345655"));

echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (<br>";
echo '("Alex", "220401", "0812345678"),<br>';
echo '("Bianca", "220402", "0812345687"),<br>';
echo '("Candice", "220403", "0812345665"),<br>';
echo '("Daniel", "220404", "0812345611"),<br>';
echo '("Elena", "220405", "0812345622"),<br>';
echo '("Fiona", "220406", "0812345633"),<br>';
echo '("Gabe", "220407", "0812345644"),<br>';
echo '("Hannah", "220408", "0812345655")<br>';
echo ")<br><br>";
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>NIM</th>
        <th>Mobile</th>
    </tr>

    <?php 
    foreach ($students as $siswa) {
        echo "<tr>";
        echo "<td>" . $siswa[0] . "</td>";
        echo "<td>" . $siswa[1] . "</td>";
        echo "<td>" . $siswa[2] . "</td>";
        echo "</tr>";
    }
    ?>
</table>