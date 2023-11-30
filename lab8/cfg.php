<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = '164366_strona';

    $login = "admin";
    $pass = "admin";

    $con = new mysqli($servername, $username, $password, $dbname);

    if($con -> connect_error) {
        die('Nieudane połączenie z bazą' . $con->connect_error);
    }
?>