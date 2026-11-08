<?php 
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

//4.1
$nama = ["David", "Ethan", "Frank", "George", "Harry"];
$tinggi = ["180", "172", "168", "175", "182"];

for ($i = 0; $i < count($nama); $i++) {
    $height[$nama[$i]] = $tinggi[$i];
}

function tampil($arr) {
    $i = 0;

    foreach ($arr as $key => $val) {
        echo '"' . $key . '" => "' . $val . '"';

        if ($i != count($arr) - 1) {
            echo ", ";
        }

        $i++;
    }
}

function tampil1($arr) {
    foreach ($arr as $key => $val) {
        echo $key . ' is ' . $val . ' cm tall. <br>';
    }
}


echo '$height = (';
tampil($height);
echo ') <br><br>';
tampil1($height);

echo "<br>";

//4.2
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
echo '$weight = (';
for($i=0;$i<count($weight);$i++) {
        echo '"' . array_keys($weight)[$i] . '" => "' . array_values($weight)[$i] . '"';

        if ($i != count($weight) - 1) {
            echo ", ";
        }
}
echo ') <br><br>';


for($i=0;$i<count($weight);$i++) {
        echo array_keys($weight)[$i] . ' is ' . array_values($weight)[$i] . ' kg. <br>';
}
 ?>