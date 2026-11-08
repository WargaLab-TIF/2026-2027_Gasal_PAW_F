<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul-04-Form_Input_Handling</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        fieldset{
            background-color:bisque;
            width: 450px;
            border: 1px solid rgb(0, 0, 0);
            border-radius: 10px;
            box-shadow: 0 5px 5px rgb(0, 0, 0);
        }
        legend{
            font-weight: bolder;
            background-color: rgb(0, 148, 240);
            border-radius: 5px;
            width: 100px;
            text-align: center;
        }

        .field{
            display: flex;
            align-items:flex-start;
            margin-bottom: 10px;
        }

        .field label{
            width: 120px;
            text-align: justify;
            padding-right: 10px;
            flex-shrink: 100;
        }

        input[type = submit], input[type = reset]{
            padding: 5px 14px;
            margin-right : 10px;
        }

    </style>
</head>
<body>
    <h1>Registrasi</h1>
    
    <?php
    $errors = array();
    if (isset($_POST['surname'])){
        require 'validate.inc';
        validateName($errors, $_POST, 'surname');
        validateEmail($errors, $_POST, 'email');
        validatePassword($errors, $_POST, 'password');
        validateAddress($errors, $_POST, 'alamat_jalan');
        validateState($errors, $_POST, 'state');
        validateGender($errors, $_POST, 'gender');
        $veg = isset($_POST["sayur"]);

        if ($errors){
            echo '<h1>Invalid, correct the following errors:</h1>';
            foreach ($errors as $field => $error)
                echo htmlspecialchars("$field : $error")."<br/>";
            // tampilkan kembali form
            include 'form.inc';
        }else {
            echo '<b>Form submitted successfully with no errors</b>';
        } 
        } else{
        // tampilkan kembali form
        include 'form.inc';
        }
    ?>
    
</body>
</html>