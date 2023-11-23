<?php
session_start();
$include('cfg.php')
    function FormularzLogowania() {
        $wynik = '
        <div class="logowanie">
            <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="POST" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'"
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

    public function SprawdzLogowanie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['x1_submit'])) {
            $provided_login = $_POST['login_email'];
            $provided_password = $_POST['login_pass'];

            if ($provided_login === $this->login && $provided_password === $this->pass) {
                $_SESSION['logged_in'] = true;
                header('Location: admin.php');
                exit;
            } else {
                echo 'Błąd logowania. Spróbuj ponownie.';
            }
        }
    }

    public function WarunkiDostepu()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            echo 'Jesteś zalogowany.';
        } else {
            $this->FormularzLogowania();
        }
    }

    function ListaPodstron() {
        global $con;

        $sql = "SELECT id, page_title FROM page_list";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if($result) {
            echo '<h2>Lista Podstron</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tytuł Podstrony</th>
                    <th>Akcje</th>
                </tr>';
            while($row) {
                echo '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['tytul'] . '</td>
                        <td>
                            <form action="admin.php" method="post" style="display:inline;">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <input type="submit" value="Edytuj">
                            </form>
                            <form action="admin.php" method="post" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
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
    }

    function EdytujPodstrone($id)
    {
        $query = "SELECT * FROM podstrony WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);

        if ($result && mysqli_num_rows($result) > 0) {

            echo '<h2>Edytuj Podstronę</h2>';
            echo '<form action="admin.php" method="post">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="' . $id . '">
                    Tytuł: <input type="text" name="tytul" value="' . $row['tytul'] . '"><br>
                    Treść: <textarea name="tresc">' . $row['tresc'] . '</textarea><br>
                    Aktywna: <input type="checkbox" name="aktywna" ' . ($row['aktywna'] ? 'checked' : '') . '><br>
                    <input type="submit" value="Zapisz zmiany">
                </form>';
        } else {
            echo 'Błąd przy pobieraniu danych z bazy danych.';
        }
    }

    function DodajNowaPodstrone()
    {
        echo '<h2>Dodaj Nową Podstronę</h2>';
        echo '<form action="admin.php" method="post">
                <input type="hidden" name="action" value="insert">
                Tytuł: <input type="text" name="tytul"><br>
                Treść: <textarea name="tresc"></textarea><br>
                Aktywna: <input type="checkbox" name="aktywna"><br>
                <input type="submit" value="Dodaj">
            </form>';
    }


    function UsunPodstrone($id)
    {
        $query = "DELETE FROM podstrony WHERE id = $id LIMIT 1";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);

        if ($result) {
            echo 'Podstrona została usunięta.';
        } else {
            echo 'Błąd przy usuwaniu podstrony z bazy danych.';
        }
    }
?>