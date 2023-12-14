<?php
   // Nagłówek 1: Inicjalizacja połączenia z bazą danych
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = '164366_strona';

    $login = "admin";
    $pass = "admin";

    // Inicjalizacja połączenia z bazą danych
    $con = new mysqli($servername, $username, $password, $dbname);

    // Sprawdzenie, czy połączenie z bazą danych zostało ustanowione
    if($con -> connect_error) {
        die('Nieudane połączenie z bazą' . $con->connect_error);
    }
?>