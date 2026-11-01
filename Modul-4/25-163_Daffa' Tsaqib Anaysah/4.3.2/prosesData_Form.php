<?php
require 'validate.inc'; 

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Panggil berbagai fungsi validasi
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validateState($errors, $_POST, 'state');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Details Form - Multi Validation</title>
</head>
<body>
    <fieldset>
        <legend>Person Details</legend>
        <?php
        // Menampilkan pesan error spesifik per field jika validasi gagal
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($errors) {
                echo '<div style="color: red; margin-bottom: 15px;"><strong>Errors found:</strong><br/>';
                foreach ($errors as $field => $error) {
                    echo "- <strong>$field</strong> $error<br/>";
                }
                echo '</div>';
            } else {
                echo '<div style="color: green; margin-bottom: 15px;"><strong>Data OK! All inputs are valid.</strong></div>';
            }
        }

        // Menyisipkan kembali form (Sticky Form)
        include 'form.inc';
        ?>
    </fieldset>
</body>
</html>