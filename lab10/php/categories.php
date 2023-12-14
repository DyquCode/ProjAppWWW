<?php
function DodajKategorie($name, $parent_id = 0) {
    global $con;

    $name = mysqli_real_escape_string($con, $name);
    $parent_id = (int)$parent_id;

    $query = "INSERT INTO categories (parent_id, name) VALUES ($parent_id, '$name')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Kategoria została dodana pomyślnie.';
    } else {
        echo 'Błąd przy dodawaniu kategorii: ' . mysqli_error($con);
    }
}

function UsunKategorie($category_id) {
    global $con;

    $category_id = (int)$category_id;

    $query = "DELETE FROM categories WHERE id = $category_id OR parent_id = $category_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Kategoria została usunięta pomyślnie.';
    } else {
        echo 'Błąd przy usuwaniu kategorii: ' . mysqli_error($con);
    }
}

function EdytujKategorie($category_id, $new_name) {
    global $con;

    $category_id = (int)$category_id;
    $new_name = mysqli_real_escape_string($con, $new_name);

    $query = "UPDATE categories SET name = '$new_name' WHERE id = $category_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Kategoria została zaktualizowana pomyślnie.';
    } else {
        echo 'Błąd przy aktualizacji kategorii: ' . mysqli_error($con);
    }
}

function PokazKategorie() {
    global $con;

    $query = "SELECT id, parent_id, name FROM categories";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo '<h2>Lista Kategorii</h2>';
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row['name'];
            WyswietlPodkategorie($row['id']);
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Błąd przy pobieraniu danych z bazy danych.';
    }
}

function WyswietlPodkategorie($parent_id) {
    global $con;

    $query = "SELECT id, name FROM categories WHERE parent_id = $parent_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row['name'];
            WyswietlPodkategorie($row['id']);
            echo '</li>';
        }
        echo '</ul>';
    }
}
?>
