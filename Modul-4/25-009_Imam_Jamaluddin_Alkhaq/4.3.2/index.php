<?php
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require 'validate.inc';
	if (isset($_POST['surname'])) {
		validateName($errors, $_POST, 'surname');
	}
	if (isset($_POST['email'])) {
		validateEmail($errors, $_POST, 'email');
	}
	if ($errors) {
		echo '<h1>Invalid, correct the following errors:</h1>';
		foreach ($errors as $field => $error)
			echo "$field $error</br>";
		// tampilkan kembali form
		include 'form.inc';
	} else {
		echo 'Form submitted successfully with no errors';
	}
} else {
	// tampilkan kembali form
	include 'form.inc';
}

?>