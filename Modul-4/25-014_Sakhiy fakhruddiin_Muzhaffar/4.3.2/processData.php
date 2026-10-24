<?php
$errors = array();

if (isset($_POST['submit'])) {
    require 'validate.inc';
    
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email'); 
    
    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo "<b>" . $field . "</b>: " . $error . "<br>";
        }
        echo "<hr>";
        include 'form.inc';
    } else {
        echo '<h1>Form submitted successfully with no errors</h1>';
        foreach ($_POST as $key => $value) {
            if ($key != 'submit') {
                echo $key . " => " . $value . "<br>";
            }
        }
    }
} else {
    include 'form.inc';
}
?>