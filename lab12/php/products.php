<?php

// Funkcja wyświetlająca listę produktów
function PokazProdukty() {
    global $con;

    $current_page = basename($_SERVER['PHP_SELF']);
    $isProductsPage = ($current_page === 'produkt.php');

    $query = "SELECT * FROM products";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo '<h2>Lista Produktów</h2>';
        echo '<table>
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Cena Netto</th>
                    <th>Ilość Dostępnych Sztuk</th>
                    <th>Status Dostępności</th>
                    <th>Kategoria</th>';

        // Wyświetlanie przycisków tylko w zakładce "Produkty"
        if ($isProductsPage) {
            echo '<th>Akcje</th>';
        }

        echo '</tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td>' . $row['net_price'] . '</td>
                    <td>' . $row['available_quantity'] . '</td>
                    <td>' . ($row['availability_status'] ? 'Dostępny' : 'Niedostępny') . '</td>
                    <td>' . $row['category'] . '</td>';

            // Wyświetlanie przycisków tylko w zakładce "Produkty"
            if ($isProductsPage) {
                echo '<td>
                        <form action="produkt.php" method="get" style="display:inline;">
                            <input type="hidden" name="edit_id" value="' . $row['id'] . '">
                            <input type="submit" value="Edytuj">
                        </form>
                        <form action="produkt.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="deleteProduct">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <input type="submit" value="Usuń">
                        </form>
                    </td>';
            } else if(!$isProductsPage) {
                echo '<td>
                <form action="sklep.php" method="post">
                    <input type="hidden" name="action" value="addToCart">
                    <input type="hidden" name="product_id" value="' . $row['id'] . '">
                    Ilość: <input type="number" name="quantity" value="1" min="1">
                    <input type="submit" value="Dodaj do koszyka">
                </form>
                </td>';
            }

            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Błąd przy pobieraniu danych z bazy danych.';
    }
}

// Funkcja dodająca nowy produkt
function DodajProdukt($data) {
    global $con;

    $title = mysqli_real_escape_string($con, $data['title']);
    $description = mysqli_real_escape_string($con, $data['description']);
    $net_price = (float)$data['net_price'];
    $vat_rate = (float)$data['vat_rate'];
    $available_quantity = (int)$data['available_quantity'];
    $availability_status = isset($data['availability_status']) ? 1 : 0;
    $category = mysqli_real_escape_string($con, $data['category']);
    $dimensions = mysqli_real_escape_string($con, $data['dimensions']);
    $image_url = mysqli_real_escape_string($con, $data['image_url']);

    $query = "INSERT INTO products (title, description, net_price, vat_rate, available_quantity, availability_status, category, dimensions, image_url) 
              VALUES ('$title', '$description', $net_price, $vat_rate, $available_quantity, $availability_status, '$category', '$dimensions', '$image_url')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Produkt został dodany pomyślnie.';
    } else {
        echo 'Błąd przy dodawaniu produktu: ' . mysqli_error($con);
    }
}

// Funkcja usuwająca produkt
function UsunProdukt($id) {
    global $con;

    $id = (int)$id;

    $query = "DELETE FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Produkt został usunięty pomyślnie.';
    } else {
        echo 'Błąd przy usuwaniu produktu: ' . mysqli_error($con);
    }
}

// Funkcja edytująca produkt
function EdytujProdukt($id, $data) {
    global $con;

    $id = (int)$id;
    $title = mysqli_real_escape_string($con, $data['title']);
    $description = mysqli_real_escape_string($con, $data['description']);
    $net_price = (float)$data['net_price'];
    $vat_rate = (float)$data['vat_rate'];
    $available_quantity = (int)$data['available_quantity'];
    $availability_status = isset($data['availability_status']) ? 1 : 0;
    $category = mysqli_real_escape_string($con, $data['category']);
    $dimensions = mysqli_real_escape_string($con, $data['dimensions']);
    $image_url = mysqli_real_escape_string($con, $data['image_url']);

    $query = "UPDATE products SET 
              title = '$title', 
              description = '$description', 
              net_price = $net_price, 
              vat_rate = $vat_rate, 
              available_quantity = $available_quantity, 
              availability_status = $availability_status, 
              category = '$category', 
              dimensions = '$dimensions', 
              image_url = '$image_url' 
              WHERE id = $id";

    $result = mysqli_query($con, $query);

    if ($result) {
        echo 'Produkt został zaktualizowany pomyślnie.';
    } else {
        echo 'Błąd przy aktualizacji produktu: ' . mysqli_error($con);
    }
}

function PobierzProduktById($id) {
    global $con;

    $id = (int)$id;

    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
?>
