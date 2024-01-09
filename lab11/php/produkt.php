<?php
include('../cfg.php');
include('../admin/admin.php');
include('products.php');

$editMode = false;

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    WarunkiDostepu();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'addProduct':
            DodajProdukt($_POST);
            break;
        case 'deleteProduct':
            UsunProdukt($_POST['id']);
            break;
        case 'editProduct':
            $editMode = true;
            $productId = $_POST['id'];
            break;
    }
}

$productToEdit = null;
if ($editMode && isset($productId)) {
    $productToEdit = PobierzProduktById($productId);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="../css/style_product.css">
</head>
<body>

<form action="produkt.php" method="post">
    <?php
    if ($editMode) {
        echo '<input type="hidden" name="action" value="editProduct">';
        echo '<input type="hidden" name="id" value="' . $productId . '">';
    } else {
        echo '<input type="hidden" name="action" value="addProduct">';
    }
    ?>

    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $editMode && isset($productToEdit['title']) ? $productToEdit['title'] : ''; ?>" required>

    <label for="description">Description:</label>
    <textarea name="description" required><?php echo $editMode ? $productToEdit['description'] : ''; ?></textarea>

    <label for="net_price">Net Price:</label>
    <input type="number" name="net_price" step="0.01" value="<?php echo $editMode ? $productToEdit['net_price'] : ''; ?>" required>

    <label for="vat_rate">VAT Rate:</label>
    <input type="number" name="vat_rate" step="0.01" value="<?php echo $editMode ? $productToEdit['vat_rate'] : ''; ?>" required>

    <label for="available_quantity">Available Quantity:</label>
    <input type="number" name="available_quantity" value="<?php echo $editMode ? $productToEdit['available_quantity'] : ''; ?>" required>

    <label for="category">Category:</label>
    <input type="text" name="category" value="<?php echo $editMode ? $productToEdit['category'] : ''; ?>" required>

    <label for="dimensions">Dimensions:</label>
    <input type="text" name="dimensions" value="<?php echo $editMode ? $productToEdit['dimensions'] : ''; ?>">

    <label for="image_url">Image URL:</label>
    <input type="text" name="image_url" value="<?php echo $editMode ? $productToEdit['image_url'] : ''; ?>">

    <input type="submit" value="<?php echo $editMode ? 'Edytuj Produkt' : 'Dodaj Produkt'; ?>">
</form>

<?php
    PokazProdukty();
?>

</body>
</html>
