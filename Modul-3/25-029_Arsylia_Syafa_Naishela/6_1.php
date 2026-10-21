<?php
// 1. array_push()

$arrayPush = array("A");

echo 'Array awal: ("A")<br>';

array_push($arrayPush, "B");

echo "Hasil array_push: " . $arrayPush[0] . " " . $arrayPush[1];

echo "<br><br>";


// 2. array_merge()

$array1 = array("A", "B");
$array2 = array("C");

echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';

$arrayMerge = array_merge($array1, $array2);

echo "Hasil array_merge: " . $arrayMerge[0] . " " . $arrayMerge[1] . " " . $arrayMerge[2];

echo "<br><br>";


// 3. array_values()

$data = array("X" => 1, "Y" => 2);

echo 'Array awal: ("X" => 1, "Y" => 2)<br>';

$values = array_values($data);

echo "Hasil array_values: " . $values[0] . " " . $values[1];

echo "<br><br>";


// 4. array_search()

$searchData = array("A", "B", "C");

echo 'Mencari "B" pada array: ("A", "B", "C")<br>';

$search = array_search("B", $searchData);

echo "Hasil array_search: " . $search;

echo "<br><br>";


// 5. array_filter()

$filterData = array(0, 1, false, 2, "", 3, "array");

echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';

$filterResult = array_filter($filterData);

echo "Hasil array_filter: " . $filterResult[1] . " " . $filterResult[3] . " " . $filterResult[5] . " " . $filterResult[6];

echo "<br><br>";


// 6. sort()

$numbers = array(3, 1, 2);

echo "Array awal: (3, 1, 2)";
echo "<br>";

sort($numbers);

echo "Hasil sort: " . $numbers[0] . " " . $numbers[1] . " " . $numbers[2];

echo "<br>";


// 7. rsort()

$numbers = array(3, 1, 2);

rsort($numbers);

echo "Hasil rsort: " . $numbers[0] . " " . $numbers[1] . " " . $numbers[2];

echo "<br><br>";


// 8. asort()

$people = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

$peopleAsort = $people;

asort($peopleAsort);

echo "Hasil asort: Peter=>" . $peopleAsort["Peter"] . ", Ben=>" . $peopleAsort["Ben"] . ", Joe=>" . $peopleAsort["Joe"];

echo "<br>";


// 9. arsort()

$peopleArsort = $people;


arsort($peopleArsort);

echo "Hasil arsort: Joe=>" . $peopleArsort["Joe"] . ", Ben=>" . $peopleArsort["Ben"] . ", Peter=>" . $peopleArsort["Peter"];

echo "<br>";


// 10. ksort()

$peopleKsort = $people;

ksort($peopleKsort);

echo "Hasil ksort: Ben=>" . $peopleKsort["Ben"] . ", Joe=>" . $peopleKsort["Joe"] . ", Peter=>" . $peopleKsort["Peter"];

echo "<br>";


// 11. krsort()

$peopleKrsort = $people;

krsort($peopleKrsort);

echo "Hasil krsort: Peter=>" . $peopleKrsort["Peter"] . ", Joe=>" . $peopleKrsort["Joe"] . ", Ben=>" . $peopleKrsort["Ben"];

?>