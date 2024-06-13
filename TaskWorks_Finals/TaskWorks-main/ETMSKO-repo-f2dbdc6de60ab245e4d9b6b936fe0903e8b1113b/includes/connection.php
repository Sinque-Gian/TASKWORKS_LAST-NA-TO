<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection, "etmsko_db");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "";
    }
?>
