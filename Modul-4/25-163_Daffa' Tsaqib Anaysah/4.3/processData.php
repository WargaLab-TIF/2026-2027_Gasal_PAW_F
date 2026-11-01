<?php
echo '<h3>Posted data:</h3>';
    foreach ($_POST as $key => $value) {
        echo "($key) => ($value)<br>";
    }
?>