<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
echo "students = (<br>";
foreach ($students as $row) {
    echo '("' . implode('", "', $row) . '"),<br>';
}
echo ")<br><br>";

array_push($students, 
    array("Daniel", "220404", "0812345611"),
    array("Elena", "220405", "0812345622"),
    array("Fiona", "220406", "0812345633"),
    array("Gabe", "220407", "0812345644"),
    array("Hannah", "220408", "0812345655")
);

echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (<br>";
foreach ($students as $row) {
    echo '("' . implode('", "', $row) . '"),<br>';
}
echo ")<br><br>";

?>
<table border="1" cellspacing="1" cellpadding="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student[0]; ?></td>
            <td><?php echo $student[1]; ?></td>
            <td><?php echo $student[2]; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>