<?php
function br(){
    echo "<br>";
}

function cetak($array){
    $banyak = count($array);
    echo "(<br>";
    for ($i=0; $i <$banyak ; $i++) {
        echo '("'.$array[$i][0].'", "'.$array[$i][1].'", "'.$array[$i][2].'")<br>';
    }
    echo ")";
}

$students = [
    ["alex","220401","0812345678"],
    ["Bianca","220402","0812345687"],
    ["Candice","220403","0812345665"],
];
echo "Data awal: <br>students = ";
cetak($students);
br();br();

array_push($students,["Daniel","220404","0812345611"],["Elena","220405","0812345622"],["Fiona","220406","0812345633"],["Gable","220407","0812345644"],["Hannah","220408","0812345655"]);
echo "Data setelah ditambah 5 data lain: <br>students = ";
cetak($students);
br();br();

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1px" solid black>
        <tr>
            <th>
                Name
            </th>
            <th>
                NIM
            </th>
            <th>
                Mobile
            </th>
        </tr>
        <?php
        $banyak = count($students);
        for ($i=0; $i <$banyak ; $i++) {
            echo "<tr>
            <td>
            ".$students[$i][0]
            ."</td>
            <td>
            ".$students[$i][1]
            ."</td>
            <td>
            ".$students[$i][2]
            ."</td>
            </tr>";
        }

         ?>
    </table>
</body>

</html>