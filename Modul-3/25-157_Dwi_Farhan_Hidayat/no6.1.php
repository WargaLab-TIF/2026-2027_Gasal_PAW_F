<?php 
// ini array_push
	$array1 = ["A"];
	foreach ($array1 as $data) {
		echo " Array Awal : ($data)";
	};
	array_push($array1, "B");
	echo "<br>Hasil array_push : ";
	foreach ($array1 as $data) {
		echo " $data";
	};

// ini array_merge
	$array2 = ["C"];
	echo "<br><br>";
	echo "Array Awal : (";
	foreach ($array1 as $data) {
		echo "$data";
	};
	echo ")";
	echo " Digabung dengan : (";
	foreach ($array2 as $data) {
		echo "$data";
	};
	echo ")";
	$gabung = array_merge($array1, $array2);
	echo "<br>Hasil Gabung : ";
	foreach ($gabung as $data) {
		echo "$data ";
	};

// ini array value
	$array_1 = ["x"=>1, "y"=>2];
	echo '<br><br>Array awal: ("x" => 1, "y" => 2)<br>';
	$panjang = count($array_1);
	echo "Hasil array_values : ";
	$values = array_values($array_1);
	for ($i=0; $i < $panjang ; $i++) { 
		echo " " . $values[$i];
	}

// ini array search
	$array_search = ["A", "B", "C"];
	echo "<br><br>Mencari B pada array (A, B, C)";
	$search = array_search("B", $array_search);
	echo "<br>Hasil array_search : " . $search;

// ini array filter
	$array_filter = [0, 1, false, 2, "", 3, "array"];
	echo '<br><br>Array awal: (0, 1, false, 2, "", 3, "array")<br>';
	$hasil = array_filter($array_filter);
	echo "Hasil array_filter: ";
	foreach ($hasil as $simpan) {
	    if ($simpan === true) {
	        echo "1 ";
	    } else {
	        echo $simpan . " ";
	    }
	}

// array short & rsort
	$array = [3,1,2];
	echo "<br><br>Array awal: (3, 1, 2)";
	$array_sort = $array;
	sort($array_sort);
	echo "<br>Hasil sort : ";
	foreach ($array_sort as $data) {
		echo "$data";
	};

	$array_rsort = $array;
	rsort($array_rsort);
	echo "<br>Hasil Rsort : ";
	foreach ($array_rsort as $data) {
		echo "$data";
	};

//sisanya
	$array_sisa = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
	echo '<br><br>Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';
	$array_asort = $array_sisa;
	asort($array_asort);
	echo "Hasil asort: ";
	$total = count($array_asort);
	$count = 0;
	foreach($array_asort as $k => $v) {
	    echo "$k=> $v";
	    $count++;
	    if ($count < $total) {
	        echo ", ";
	    } else {
	        echo ",";
	    }
	}
	echo "<br>";

	$array_ksort = $array_sisa;
	ksort($array_ksort);
	echo "Hasil ksort: ";
	$total = count($array_ksort);
	$count = 0;
	foreach($array_ksort as $k => $v) {
	    echo "$k=> $v";
	    $count++;
	    if ($count < $total) {
	        echo ", ";
	    } else {
	        echo ",";
	    }
	}
	echo "<br>";

	$array_arsort = $array_sisa;
	arsort($array_arsort);
	echo "Hasil arsort: ";
	$total = count($array_arsort);
	$count = 0;
	foreach($array_arsort as $k => $v) {
	    echo "$k=> $v";
	    $count++;
	    if ($count < $total) {
	        echo ", ";
	    } else {
	        echo ",";
	    }
	}
	echo "<br>";

	$array_krsort = $array_sisa;
	krsort($array_krsort);
	echo "Hasil krsort: ";
	$total = count($array_krsort);
	$count = 0;
	foreach($array_krsort as $k => $v) {
	    echo "$k=> $v";
	    $count++;
	    if ($count < $total) {
	        echo ", ";
	    } else {
	        echo ",";
	    }
	}
?>