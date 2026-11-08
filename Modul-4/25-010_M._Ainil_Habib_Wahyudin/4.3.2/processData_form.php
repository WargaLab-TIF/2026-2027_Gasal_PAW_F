<?php
$errors = array();
if (isset($_POST['surname'])){
  require 'validate.inc';
    foreach ($_POST as $key => $val) {
    if (in_array($key, ['surname', 'email', 'passwd', 'address', 'sex'])) {
        validateName($errors, $_POST, $key);
    }
    }

  if ($errors){
    echo '<h1>Invalid, correct the following errors:</h1>';
    foreach ($errors as $field => $error)
    echo "$field $error</br>";
    // tampilkan kembali form
    include 'form.inc';
  }

  else {
    echo 'Form submitted successfully with no errors';
} } else
include 'form.inc';

?>
