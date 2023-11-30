<?php
    function PokazPodstrone($id) {
        
        global $con;
        
        $id_clear = htmlspecialchars($id);

        $sql = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        if(empty($row['id'])) {
            $web = '[nie_znaleziono_strony]';
        } else {
            $web = $row['page_content'];
        }

        return $web;
    }
?>