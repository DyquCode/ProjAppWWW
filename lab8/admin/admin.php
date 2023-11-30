<?php
session_start();
include('../cfg.php');

function FormularzLogowania() {
    global $login, $pass;
    $wynik = '
        <div class="logowanie">
            <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="POST" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                    <table class="logowanie">
                        <tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie"/></td></tr>
                        <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie"/></td></tr>
                        <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="ZALOGUJ"/></td></tr>
                    </table>
                </form>
            </div>
        </div>';

    return $wynik;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['x1_submit'])) {
    $provided_login = $_POST['login_email'];
    $provided_password = $_POST['login_pass'];

    if ($provided_login === $login && $provided_password === $pass) {
        $_SESSION['logged_in'] = true;
        WarunkiDostepu();
    } else {
        echo 'Błąd Logowania';
        echo FormularzLogowania();
    }
}

function WarunkiDostepu()
{
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        ListaPodstron();
    } else {
        echo 'Brak dostępu. Zaloguj się, aby uzyskać dostęp.';
        echo FormularzLogowania();
    }
}

function ListaPodstron() {
    global $con;

    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo '<h2>Lista Podstron</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tytuł Podstrony</th>
                <th>Akcje</th>
            </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['page_title'] . '</td>
                    <td>
                        <form action="admin.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="editPage">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <input type="submit" value="Edytuj">
                        </form>
                        <form action="admin.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="deletePage">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <input type="submit" value="Usuń">
                        </form>
                    </td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo 'Błąd bazy';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] === 'editPage') {
            $id = $_POST['id'];
            EdytujPodstrone($id);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] === 'deletePage') {
            $id = $_POST['id'];
            UsunPodstrone($id);
        }
    }

    DodajNowaPodstrone();
}

function EdytujPodstrone($id)
{
    global $con;

    $query = "SELECT * FROM page_list WHERE id = $id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<h2>Edytuj Podstronę</h2>';
        echo '<form action="admin.php" method="post">';
        echo '<input type="hidden" name="action" value="update">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo 'Tytuł: <input type="text" name="tytul" value="' . $row['page_title'] . '"><br>';
        echo 'Treść: <textarea name="tresc">' . $row['page_content'] . '</textarea><br>';
        echo 'Aktywna: <input type="checkbox" name="aktywna" ' . ($row['status'] ? 'checked' : '') . '><br>';
        echo '<input type="submit" value="Zapisz zmiany">';
        echo '</form>';
    } else {
        echo 'Błąd przy pobieraniu danych z bazy danych.';
    }

        $updatedTitle = isset($_POST['tytul']) ? mysqli_real_escape_string($con, $_POST['tytul']) : '';
        $updatedContent = isset($_POST['tresc']) ? mysqli_real_escape_string($con, $_POST['tresc']) : '';
        $isActive = isset($_POST['aktywna']) ? 1 : 0;

        $updateQuery = "UPDATE page_list SET page_title = '$updatedTitle', page_content = '$updatedContent', status = $isActive WHERE id = $id";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            exit();
        } else {
            echo 'Błąd podczas aktualizacji podstrony: ' . mysqli_error($con);
        }
}


    function DodajNowaPodstrone()
    {
        global $con;
        echo '<h2>Dodaj Nową Podstronę</h2>';
        echo '<form action="admin.php" method="post">
                <input type="hidden" name="action" value="insert">
                Tytuł: <input type="text" name="tytul"><br>
                Treść: <textarea name="tresc"></textarea><br>
                Aktywna: <input type="checkbox" name="aktywna"><br>
                <input type="submit" value="Dodaj">
            </form>';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'insert') {
                $tytul = $_POST['tytul'];
                $tresc = $_POST['tresc'];
                $aktywna = isset($_POST['aktywna']) ? 1 : 0;
        
                $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$tytul', '$tresc', '$aktywna')";
                $result = mysqli_query($con, $query);
        
                if ($result) {
                    echo 'Nowa podstrona została dodana pomyślnie.';
                } else {
                    echo 'Błąd podczas dodawania nowej podstrony.';
                }
            }
    }


    function UsunPodstrone($id)
    {
        global $con;
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo 'Podstrona została usunięta.';
        } else {
            echo 'Błąd przy usuwaniu podstrony z bazy danych.';
        }
    }

    WarunkiDostepu();
?>