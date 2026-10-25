<?php
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'validate.inc';

    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateGender($errors, $_POST, 'sex');

    if ($errors) {
        echo '<h1 style="color:red;">Invalid, correct the following errors:</h1>';
        echo '<ul style="color:red;">';
        foreach ($errors as $field => $error) {
            echo "<li><b>$field</b>: $error</li>";
        }
        echo '</ul>';
        
        include 'form.inc';
    } else {
        echo '<h1 style="color:green;">Form submitted successfully with no errors</h1>';
        echo '<h3>Summary of Submitted Data:</h3>';
        echo '<ul>';
        echo '<li><b>Surname:</b> ' . htmlspecialchars($_POST['surname']) . '</li>';
        echo '<li><b>Email:</b> ' . htmlspecialchars($_POST['email']) . '</li>';
        echo '<li><b>Address:</b> ' . htmlspecialchars($_POST['address']) . '</li>';
        echo '<li><b>State:</b> ' . htmlspecialchars($_POST['state']) . '</li>';
        echo '<li><b>Country:</b> ' . htmlspecialchars($_POST['country']) . '</li>';
        echo '<li><b>Gender:</b> ' . htmlspecialchars($_POST['sex']) . '</li>';
        echo '<li><b>Vegetarian:</b> ' . (isset($_POST['vegetarian']) ? 'Yes' : 'No') . '</li>';
        echo '</ul>';
    }
} else {
    include 'form.inc';
}
?>