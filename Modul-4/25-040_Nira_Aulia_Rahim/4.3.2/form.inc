<form name="myForm" action="processData.php" method="POST">
    First Name:
    <input type="text" name="firstname" value="<?php
        if (isset($_POST['firstname']))
            echo htmlspecialchars($_POST['firstname']);
    ?>">
    <br><br>

    Surname:
    <input type="text" name="surname" value="<?php
        if (isset($_POST['surname']))
            echo htmlspecialchars($_POST['surname']);
    ?>">
    <br><br>

    <input type="submit" value="Submit">
</form>
