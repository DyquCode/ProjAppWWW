<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Internetowy</title>
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

<?php
include('../cfg.php');
include('../admin/admin.php');
include('products.php');
include('basket.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addToCart') {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $product_data = PobierzDaneProduktu($product_id);

    if ($product_data) {
        DodajDoKoszyka($product_id, $quantity, $product_data['net_price'], $product_data['vat_rate']);
        echo 'Produkt został dodany do koszyka.';
    }
}

PokazProdukty();
?>
</body>
</html>
