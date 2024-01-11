<?php
// Inicjalizacja sesji i dołączenie pliku konfiguracyjnego
session_start();
include('../cfg.php');

function SprawdzDostep() {
    global $con;

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
        header('Location: login.php'); // Przekierowanie do formularza logowania
        exit();
    }
}




// Główna logika obsługi logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['x1_submit'])) {
    $provided_login = $_POST['login_email'];
    $provided_password = $_POST['login_pass'];

    // Sprawdź dane logowania w bazie danych
    $query = "SELECT * FROM users WHERE username = '$provided_login' AND password = '$provided_password'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $user_data['role'];
    } else {
        echo 'Błąd Logowania';
        header('Location: login.php');
        exit();
    }
}

// Funkcja wyświetlająca listę podstron
function ListaPodstron()
{
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
                        <form action="podstrony.php" method="get" style="display:inline;">
                            <input type="hidden" name="edit_id" value="' . $row['id'] . '">
                            <input type="submit" value="Edytuj">
                        </form>
                        <form action="podstrony.php" method="post" style="display:inline;">
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
}



// Funkcja do edycji podstrony
function EdytujPodstrone($id, $data)
{
    global $con;

    $id = (int)$id;
    $updatedTitle = mysqli_real_escape_string($con, $data['title']);
    $updatedContent = mysqli_real_escape_string($con, $data['content']);
    $isActive = isset($data['status']) ? 1 : 0;

    $query = "UPDATE page_list SET page_title = '$updatedTitle', page_content = '$updatedContent', status = $isActive WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Podstrona została zaktualizowana pomyślnie.';
    } else {
        echo 'Błąd podczas aktualizacji podstrony: ' . mysqli_error($con);
    }
}


// Funkcja dodająca nową podstronę
function DodajNowaPodstrone($data)
{
    global $con;

    $title = mysqli_real_escape_string($con, $data['title']);
    $content = mysqli_real_escape_string($con, $data['content']);
    $isActive = isset($data['status']) ? 1 : 0;

    $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$content', $isActive)";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Nowa podstrona została dodana pomyślnie.';
    } else {
        echo 'Błąd podczas dodawania nowej podstrony: ' . mysqli_error($con);
    }
}


// Funkcja usuwająca podstronę
function UsunPodstrone()
{
    global $con;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'deletePage') {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        if ($id > 0) {
            $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo 'Podstrona została usunięta.';
            } else {
                echo 'Błąd przy usuwaniu podstrony z bazy danych: ' . mysqli_error($con);
            }
        } else {
            echo 'Nieprawidłowe ID podstrony.';
        }
    }
}

function PobierzPodstroneById($id) {
    global $con;

    $id = (int)$id;

    $query = "SELECT * FROM page_list WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}