<?php
// Funkcja do wyświetlania treści strony na podstawie identyfikatora
    function PokazPodstrone($id) {
        
        global $con;
        
        $id_clear = htmlspecialchars($id);

        // Zapytanie SQL do pobrania treści strony
        $sql = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";

        // Wykonanie zapytania do bazy danych
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);


        // Sprawdzenie, czy istnieją dane dla podanego identyfikatora
        if(empty($row['id'])) {
            $web = '[nie_znaleziono_strony]';
        } else {
            $web = $row['page_content'];
        }
        
        return $web;
    }
?>