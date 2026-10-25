<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Workshop</title>
    <style>
        body {
            font-family: Verdana, Geneva, sans-serif;
            font-size: 13px;
            margin: 20px 40px;
        }

        h2 {
            font-size: 26px;
        }

        fieldset {
            width: 480px;
            padding: 15px;
            background-color: #ccccff;
            border: 1px solid #666;
        }

        legend {
            font-weight: bold;
            font-size: 14px;
        }

        .field {
            margin-bottom: 6px;
        }

        .field label {
            display: inline-block;
            width: 130px;
            text-align: right;
            margin-right: 8px;
            vertical-align: top;
        }

        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"],
        .field textarea {
            width: 230px;
        }

        .field textarea {
            resize: none;
        }

        .buttons {
            margin-left: 142px;
        }
    </style>
</head>
<body>
    <h2>Daftar Workshop</h2>
    <fieldset>
        <legend>Data Peserta</legend>
        <?php
        $errors = array();

        if (isset($_POST['surname']))
        {
            require 'validate.inc';
            validateName($errors, $_POST, 'surname');
            validateEmail($errors, $_POST, 'email');
            validatePassword($errors, $_POST, 'passwd');
            validateRequired($errors, $_POST, 'address');
            validateSelect($errors, $_POST, 'prodi');
            validateRequired($errors, $_POST, 'sesi');

            if ($errors)
            {
                echo '<h1>Invalid, correct the following errors:</h1>';
                foreach ($errors as $field => $error)
                    echo "$field $error<br/>";

                include 'form.inc';
            }
            else
            {
                echo 'Form submitted successfully with no errors';
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