<?php 
	// require 'validate.inc';
	// if (validatename($_POST, 'surname')) {
	// 	echo "Data Ok!";
	// }else{
	// 	echo "Data Invalid";
	// }
	

	require 'validate.inc';
	$error = array();
	validatename($error, $_POST, 'surname');
	if ($error) {
        echo 'Error: <br/>';
        foreach ($error as $field => $errorr) {
            echo "$field $errorr<br/>";
	    }
    } else {
        echo 'Data OK!';
    }
?>
