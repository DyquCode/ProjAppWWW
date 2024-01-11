<?php
// Dodanie produktu do koszyka
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'addToBasket':
            DodajDoKoszyka($_POST['product_id'], $_POST['quantity']);
            break;
        case 'removeFromBasket':
            UsunZKoszyka($_POST['product_id']);
            break;
        case 'updateQuantity':
            AktualizujIlosc($_POST['product_id'], $_POST['quantity']);
            break;
    }
}

PokazKoszyk();

// Funkcja dodająca produkt do koszyka
function DodajDoKoszyka($product_id, $quantity, $net_price, $vat_rate) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $product_data = [
        'id' => $product_id,
        'net_price' => $net_price,
        'vat_rate' => $vat_rate,
    ];

    if ($product_data) {
        // Dodanie produktu do koszyka
        $_SESSION['basket'][$product_id] = [
            'quantity' => $quantity,
            'price' => ObliczCeneBrutto($net_price, $vat_rate),
        ];

        header('Location: sklep.php');
        exit();
    } else {
        echo 'Błąd przy dodawaniu produktu do koszyka.';
    }
}

// Funkcja usuwająca produkt z koszyka
function UsunZKoszyka($product_id) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['basket']) && isset($_SESSION['basket'][$product_id])) {
        unset($_SESSION['basket'][$product_id]);

        if (empty($_SESSION['basket'])) {
            echo 'Produkt został usunięty z koszyka. Koszyk jest pusty.';
            header('Location: sklep.php');
        } else {
            echo 'Produkt został usunięty z koszyka.';
            header('Location: sklep.php');
        }
    } else {
        echo 'Błąd przy usuwaniu produktu z koszyka. Koszyk może być już pusty.';
        header('Location: sklep.php');
    }
}

// Funkcja aktualizująca ilość produktu w koszyku
function AktualizujIlosc($product_id, $quantity) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['basket']) && isset($_SESSION['basket'][$product_id])) {
        $_SESSION['basket'][$product_id]['quantity'] = $quantity;
        echo 'Ilość produktu została zaktualizowana.';
        header('Location: sklep.php');
    } else {
        echo 'Błąd przy aktualizacji ilości produktu w koszyku. Koszyk może być już pusty.';
        header('Location: sklep.php');
    }
}

// Funkcja wyświetlająca zawartość koszyka
function PokazKoszyk() {
    if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) {
        echo '<h2>Koszyk</h2>';
        echo '<table>
                <tr>
                    <th>ID Produktu</th>
                    <th>Ilość</th>
                    <th>Cena Brutto</th>
                    <th>Wartość Całości</th>
                    <th>Akcje</th>
                </tr>';

        foreach ($_SESSION['basket'] as $product_id => $item) {
            $product_data = PobierzDaneProduktu($product_id);

            $totalValue = $item['quantity'] * $product_data['net_price'] * (1 + $product_data['vat_rate'] / 100);

            echo '<tr>
                    <td>' . $product_id . '</td>
                    <td>' . $item['quantity'] . '</td>
                    <td>' . $item['price'] . '</td>
                    <td>' . $totalValue . '</td>
                    <td>
                        <form action="basket.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="updateQuantity">
                            <input type="hidden" name="product_id" value="' . $product_id . '">
                            <input type="number" name="quantity" value="' . $item['quantity'] . '">
                            <input type="submit" value="Aktualizuj" class="gray-accent">
                        </form>
                        <form action="basket.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="removeFromBasket">
                            <input type="hidden" name="product_id" value="' . $product_id . '">
                            <input type="submit" value="Usuń" class="gray-accent">
                        </form>
                    </td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo 'Koszyk jest pusty.';
    }
}

// Funkcja pobierająca dane produktu z bazy danych
function PobierzDaneProduktu($product_id) {
    global $con;
    
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    
        $product_data = [
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'net_price' => $row['net_price'],
            'vat_rate' => $row['vat_rate'],
        ];
    
        return $product_data;
    } else {
        return false;
    }
}

// Funkcja obliczająca cenę brutto na podstawie ceny netto i stawki VAT
function ObliczCeneBrutto($net_price, $vat_rate) {
    return $net_price * (1 + $vat_rate / 100);
}
?>
