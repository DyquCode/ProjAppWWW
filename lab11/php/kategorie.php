<?php
include('../cfg.php');
include('../admin/admin.php');
include('categories.php');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    ?>

    <button onclick="DodajKategorie('Category 1')">Dodaj Category 1</button>
    <button onclick="DodajKategorie('Category 2', 1)">Dodaj Category 2</button>
    <button onclick="UsunKategorie(2)">Usun Category 2</button>
    <button onclick="EdytujKategorie(1, 'Updated Category 1')">Edytuj Category 1</button>

    <?php
    PokazKategorie();
} else {
    WarunkiDostepu();
}
?>