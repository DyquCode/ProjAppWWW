<?php
include('../cfg.php');
include('products.php');
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'addProduct':
            $data = array(
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'net_price' => $_POST['net_price'],
                'vat_rate' => $_POST['vat_rate'],
                'available_quantity' => $_POST['available_quantity'],
                'availability_status' => isset($_POST['availability_status']) ? 1 : 0,
                'category' => $_POST['category'],
                'dimensions' => $_POST['dimensions'],
                'image_url' => $_POST['image_url'],
            );

            DodajProdukt($data);
            break;

        case 'editProduct':            
            if ($_POST["id"] !== null) {
                $data = array(
                    'title' => isset($_POST['title']) ? $_POST['title'] : '',
                    'description' => isset($_POST['description']) ? $_POST['description'] : '',
                    'net_price' => isset($_POST['net_price']) ? $_POST['net_price'] : '',
                    'vat_rate' => isset($_POST['vat_rate']) ? $_POST['vat_rate'] : '',
                    'available_quantity' => isset($_POST['available_quantity']) ? $_POST['available_quantity'] : '',
                    'availability_status' => isset($_POST['availability_status']) ? 1 : 0,
                    'category' => isset($_POST['category']) ? $_POST['category'] : '',                        'dimensions' => isset($_POST['dimensions']) ? $_POST['dimensions'] : '',
                    'image_url' => isset($_POST['image_url']) ? $_POST['image_url'] : '',
                    );
            
                    EdytujProdukt($_POST["id"], $data);
                } else {
                    echo 'Błąd: Brak ID produktu do edycji.';
                }
                break;

        case 'deleteProduct':
            $id = $_POST['id'];
            UsunProdukt($id);
            break;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt</title>
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

<div class="product-form">
    <h2>Dodaj Nowy Produkt</h2>
    <form action="produkt.php" method="post">
        <input type="hidden" name="action" value="addProduct">
        
        <label for="title">Tytuł:</label>
        <input type="text" name="title" required>

        <label for="description">Opis:</label>
        <textarea name="description"></textarea>

        <label for="net_price">Cena Netto:</label>
        <input type="text" name="net_price" required>

        <label for="vat_rate">Stawka VAT:</label>
        <input type="text" name="vat_rate" required>

        <label for="available_quantity">Dostępna Ilość:</label>
        <input type="text" name="available_quantity" required>

        <label for="availability_status">Status Dostępności:</label>
        <select name="availability_status" required>
            <option value="1">Dostępny</option>
            <option value="0">Niedostępny</option>
        </select>

        <label for="category">Kategoria:</label>
        <input type="text" name="category">

        <label for="dimensions">Wymiary:</label>
        <input type="text" name="dimensions">

        <label for="image_url">URL Obrazu:</label>
        <input type="text" name="image_url">

        <input type="submit" value="Dodaj Produkt">
    </form>
</div>

<?php PokazProdukty(); ?>

<div class="product-form">
    <h2>Edytuj Produkt</h2>
    <?php
    if(isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        $editProduct = PobierzProduktById($edit_id);

        if ($editProduct) {
    ?>
            <form action="produkt.php" method="post">
                <input type="hidden" name="action" value="editProduct">

                <label for="id">ID:</label>
                <input type="hidden" name="id" readonly value="<?php echo $editProduct['id']; ?>">

                <label for="title">Tytuł:</label>
                <input type="text" name="title" required value="<?php echo $editProduct['title']; ?>">

                <label for="description">Opis:</label>
                <textarea name="description"><?php echo $editProduct['description']; ?></textarea>

                <label for="net_price">Cena Netto:</label>
                <input type="text" name="net_price" required value="<?php echo $editProduct['net_price']; ?>">

                <label for="vat_rate">Stawka VAT:</label>
                <input type="text" name="vat_rate" required value="<?php echo $editProduct['vat_rate']; ?>">

                <label for="available_quantity">Dostępna Ilość:</label>
                <input type="text" name="available_quantity" required value="<?php echo $editProduct['available_quantity']; ?>">

                <label for="availability_status">Status Dostępności:</label>
                <select name="availability_status" required>
                    <option value="1" <?php echo ($editProduct['availability_status'] == 1) ? 'selected' : ''; ?>>Dostępny</option>
                    <option value="0" <?php echo ($editProduct['availability_status'] == 0) ? 'selected' : ''; ?>>Niedostępny</option>
                </select>

                <label for="category">Kategoria:</label>
                <input type="text" name="category" value="<?php echo $editProduct['category']; ?>">

                <label for="dimensions">Wymiary:</label>
                <input type="text" name="dimensions" value="<?php echo $editProduct['dimensions']; ?>">

                <label for="image_url">URL Obrazu:</label>
                <input type="text" name="image_url" value="<?php echo $editProduct['image_url']; ?>">

                <input type="submit" value="Zapisz Zmiany">
            </form>
    <?php
        } else {
            echo 'Produkt o podanym ID nie istnieje.';
        }
    }
    ?>
</div>


</body>
</html>
