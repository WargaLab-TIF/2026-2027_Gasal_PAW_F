<?php
$students = array (
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),
    array("Daniel", "220404", "0812345611"),
    array("Elena", "220405", "0812345622"),
    array("Fiona", "220406", "0812345633"),
    array("Gabe", "220407", "0812345644"),
    array("Hannah", "220408", "0812345655")
);
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>NIM</th>
        <th>Mobile</th>
    </tr>
    <?php
    for ($row = 0; $row < count($students); $row++) {
        echo "<tr>";
        echo "<td>" . $students[$row][0] . "</td>";
        echo "<td>" . $students[$row][1] . "</td>";
        echo "<td>" . $students[$row][2] . "</td>";
        echo "</tr>";
    }
    ?>
</table>