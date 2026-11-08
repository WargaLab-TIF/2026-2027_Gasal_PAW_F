<?php
	$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
	foreach ($matkul as $nama_matkul) {
		switch ($nama_matkul) {
			case 'PTI':
				echo "Saya sukaa PTI"."<br>";
				break;
			case 'ALPRO':
				echo "Saya sukaa ALPRO"."<br>";
				break;
			case 'DPW':
				echo "Saya sukaa DPW"."<br>";
				break;
			case 'STRUKDAT':
				echo "Saya sukaa STRUKDAT"."<br>";
				break;
			case 'JARKOM':
				echo "Saya sukaa JARKOM"."<br>";
				break;
			case 'PAW':
				echo "Saya sukaa PAW"."<br>";
				break;
			default:
				echo "Saya tidak mengambil Matkul " . $nama_matkul."<br>";
				break;
		}
	}
?>