<?php
include('../cfg.php');
include('../admin/admin.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'addPage':
            $data = array(
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'status' => isset($_POST['status']) ? 1 : 0,
            );

            DodajNowaPodstrone($data);
            break;

            case 'editPage':            
                if ($_POST["id"] !== null) {
                    $data = array(
                        'title' => isset($_POST['title']) ? $_POST['title'] : '',
                        'content' => $_POST['content'],
                        'status' => isset($_POST['status']) ? 1 : 0,
                        );
                
                        EdytujPodstrone($_POST["id"], $data);
                    } else {
                        echo 'Błąd: Brak ID produktu do edycji.';
                    }
                    break;

        case 'deletePage':
            $id = $_POST['id'];
            UsunPodstrone($id);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podstrony</title>
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

<div class="page-form">
    <h2>Dodaj Nową Podstronę</h2>
    <form action="podstrony.php" method="post">
        <input type="hidden" name="action" value="addPage">

        <label for="title">Tytuł:</label>
        <input type="text" name="title" required>

        <label for="content">Treść:</label>
        <textarea name="content"></textarea>

        <label for="status">Status:</label>
        <input type="checkbox" name="status">

        <input type="submit" value="Dodaj Podstronę">
    </form>
</div>

<?php ListaPodstron(); ?>

<div class="page-form">
    <h2>Edytuj Podstronę</h2>
    <?php
    if(isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        $editPage = PobierzPodstroneById($edit_id);

        if ($editPage) {
    ?>
            <form action="podstrony.php" method="post">
                <input type="hidden" name="action" value="editPage">

                <label for="id">ID:</label>
                <input type="hidden" name="id" readonly value="<?php echo $editPage['id']; ?>">

                <label for="title">Tytuł:</label>
                <input type="text" name="title" required value="<?php echo isset($editPage['page_title']) ? htmlspecialchars($editPage['page_title'], ENT_QUOTES, 'UTF-8') : ''; ?>">

                <label for="content">Treść:</label>
                <textarea name="content"><?php echo isset($editPage['page_content']) ? htmlspecialchars($editPage['page_content'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>

                <label for="status">Status:</label>
                <input type="checkbox" name="status" <?php echo ($editPage['status'] == 1) ? 'checked' : ''; ?>>

                <input type="submit" value="Zapisz Zmiany">
            </form>
    <?php
        } else {
            echo 'Podstrona o podanym ID nie istnieje.';
        }
    }
    ?>
</div>

</body>
</html>
