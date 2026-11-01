<?php
	function familyName($fname,$year){
		echo $fname. " " .$year;
	}
	$br = "<br>";
	familyName("Hege born in",1975);
	echo $br;
	familyName("Stale born in",1978);
	echo $br;
	familyName("Kai Jim born in",1983);

?>