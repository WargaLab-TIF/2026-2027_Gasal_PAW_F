<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Register</h1>
	<fieldset style="width: 450px; background-color: #eef2f7;">
		<legend>Person Details</legend>
		<?php 
		    // $errors = array();
		    // if (isset($_POST['submit'])) 
		    // {
		    //     require 'validate.inc';
		    //     validatename($errors, $_POST, 'surname');
		    //     if ($errors) 
		    //     {
		    //         echo "Invalid, correct the following errors";
		    //         foreach ($errors as $field => $error) {
		    //             echo "$field $error<br/>";
		    //         }
		    //         echo '<br/>';
		    //         include 'form.inc'; 
		    //     } 
		    //     else 
		    //     {
		    //         echo "Form submitted successfully with no errors";
		    //     }
		    // } 
		    // else 
		    // {
		    //     include 'form.inc'; 
		    // }

			$errors = array();
			if (isset($_POST['submit'])) 
			{
			    require 'validate.inc';
			    validateName($errors, $_POST, 'surname');
			    validateEmail($errors, $_POST, 'email');
			    validatePassword($errors, $_POST, 'password');
			    validateState($errors, $_POST, 'state');
			    if ($errors) 
			    {
			        echo "Invalid, correct the following errors:";
			        foreach ($errors as $field => $error) {
			            echo "- <b>$field</b>: $error<br/>";
			        }
			        echo '<br/>';
			        include 'form.inc';
			    } 
			    else 
			    {
			        echo "Form submitted successfully with no errors";
			    }
			} 
			else 
			{
			    include 'form.inc';
			}
		  ?>    
	</fieldset>
</body>
</html>