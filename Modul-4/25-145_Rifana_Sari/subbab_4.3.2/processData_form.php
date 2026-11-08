<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
        }
        fieldset {
            background-color: pink;
            padding: 15px 20px;
            width: 500px;
        }
        legend {
            font-weight: bold;
        }
        .field label {
            display: inline-block;
            width: 130px;
            text-align: right;
            vertical-align: top;
        }
    </style>
</head>
<body>
	<h2>Register</h2>
	<?php
	$errors = array();

	$surname = '';
	$email = '';
	$address = '';
	$state = -1;
	$sex = '';
	$vegetarian = null;

	if (isset($_POST['submit'])) {
	    $surname = $_POST['surname'] ?? '';
	    $email = $_POST['email'] ?? '';
	    $address = $_POST['address'] ?? '';
	    $state = $_POST['state'] ?? -1;
	    $sex = $_POST['sex'] ?? '';
	    $vegetarian = $_POST['vegetarian'] ?? null;

	    require 'validate.inc';
	    
	    validateName($errors, $_POST, 'surname');
	    validateEmail($errors, $_POST, 'email');

	    if ($errors) {
	        echo '<h1>Invalid, correct the following errors:</h1>';
	        foreach ($errors as $field => $error) {
	            echo "<strong>$field</strong>: $error<br/>";
	        }
	        include 'form.inc';
	    } else {
	        echo '<h3 style="color: green;">Form submitted successfully with no errors!</h3>';
	    }
	} else {
	    include 'form.inc';
	}
	?>
</body>
</html>
