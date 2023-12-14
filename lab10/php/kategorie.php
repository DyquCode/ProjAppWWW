<?php
include('../cfg.php');
include('../admin/admin.php');
include('categories.php');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    DodajKategorie('Category 1');
    DodajKategorie('Category 2', 1);
    UsunKategorie(2);
    EdytujKategorie(1, 'Updated Category 1');

    PokazKategorie();
} else {
    echo 'Brak dostępu. Zaloguj się, aby uzyskać dostęp.';
}
?>