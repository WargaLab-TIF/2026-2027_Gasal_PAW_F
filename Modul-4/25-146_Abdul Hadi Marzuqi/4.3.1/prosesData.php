<?php
// Langkah 1-3
//require __DIR__."/validate.inc";
//if (validateName($_POST, "surname")){
//    echo "Data OK !";
//}else{
//    echo 'Data  Invalid !';
//}

// Langkah  4-6
 require 'validate.inc'; 
 $errors = array();
 validateName($errors, $_POST, 'surname'); 
 if ($errors){
     echo 'Errors:<br/>';
     foreach ($errors as $field => $error)
         echo "$field $error</br>";
     } else
     echo 'Data OK!';

?>