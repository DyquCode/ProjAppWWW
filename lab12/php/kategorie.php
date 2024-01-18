<?php
include('categories.php');
include('../cfg.php');
include('../admin/admin.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $name = $_POST['category_name'];
        $parent_id = $_POST['parent_id'];
        DodajKategorie($name, $parent_id);
    } elseif (isset($_POST['edit_category'])) {
        $category_id = $_POST['edit_category_id'];
        $new_name = $_POST['new_category_name'];
        EdytujKategorie($category_id, $new_name);
    } elseif (isset($_POST['delete_category'])) {
        $category_id = $_POST['delete_category_id'];
        UsunKategorie($category_id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie</title>
    <link rel="stylesheet" href="../css/style_shop.css">
</head>
<body>

<div class="navigation">
    <ul>
        <li><a href="sklep.php">Sklep</a></li>
        <li><a href="produkt.php">Produkty</a></li>
        <li><a href="kategorie.php">Kategorie</a></li>
        <li><a href="podstrony.php">Podstrony</a></li>
        <li><a href="logout.php">Wyloguj się</a></li>
    </ul>
</div>

<h1>Kategorie</h1>

<h2>Dodaj nową kategorię</h2>
<form method="post" action="">
    <label>Nazwa kategorii:</label>
    <input type="text" name="category_name" required>
    <label>Parent ID:</label>
    <input type="text" name="parent_id" value="0">
    <button type="submit" name="add_category">Dodaj kategorię</button>
</form>

<h2>Edytuj kategorię</h2>
<form method="post" action="">
    <label>ID kategorii do edycji:</label>
    <input type="text" name="edit_category_id" required>
    <label>Nowa nazwa:</label>
    <input type="text" name="new_category_name" required>
    <button type="submit" name="edit_category">Edytuj kategorię</button>
</form>

<h2>Usuń kategorię</h2>
<form method="post" action="">
    <label>ID kategorii do usunięcia:</label>
    <input type="text" name="delete_category_id" required>
    <button type="submit" name="delete_category">Usuń kategorię</button>
</form>

<?php PokazKategorie(); ?>

</body>
</html>