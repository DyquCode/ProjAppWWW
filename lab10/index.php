<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="pl">
<meta name="Author" content="Bartłomiej Dyk">
<title>Piłka nożna moją pasją</title>
<script src="./js/timedate.js"></script>
<link rel="stylesheet" href="./css/style.css">
    
    <div class="menu">
        <a href="index.php?idp=">Strona Główna</a>
        <a href="index.php?idp=historia">Historia</a>
        <a href="index.php?idp=wspolczesne_zasady">Współczesne zasady</a>
        <a href="index.php?idp=zawodnicy">Zawodnicy</a>
        <a href="index.php?idp=turnieje_miedzynarodowe">Turnieje międzynarodowe</a>
        <a href="index.php?idp=galeria">Galeria</a>
        <a href="index.php?idp=filmy">Filmy</a>
        <a href="index.php?idp=kontakt">Kontakt</a>
        <a href="php/kategorie.php">Kategorie</a>
    </div>
 
    <?php
        // Wczytanie konfiguracji
        include('cfg.php');
        

        // Informacje o autorze
        $nr_indeksu = '164366';
        $nrGrupy = '2ISI';
        echo 'Autor: Bartłomiej Dyk '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';

        
        // Wczytanie funkcji do wyświetlania podstrony
        include('showpage.php');
        
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);


        // Ustalenie numeru strony do wyświetlenia
        if ($_GET['idp'] == '') $strona = '1';
        elseif ($_GET['idp'] == 'historia') $strona = '2';
        elseif ($_GET['idp'] == 'wspolczesne_zasady') $strona = 3;
        elseif ($_GET['idp'] == 'zawodnicy') $strona = 4;
        elseif ($_GET['idp'] == 'turnieje_miedzynarodowe') $strona = 5;
        elseif ($_GET['idp'] == 'galeria') $strona = 6;
        elseif ($_GET['idp'] == 'filmy') $strona = 7;
        elseif ($_GET['idp'] == 'kontakt') $strona = 8;
        elseif ($_GET['idp'] == 'kategorie') $strona = 9;


        // Wyświetlenie odpowiedniej podstrony lub komunikatu o braku strony
        if (!empty($strona)) {
            echo PokazPodstrone($strona);
        } else {
            echo "Brak strony do wyświetlenia.";
        }


        // Zamknięcie połączenia z bazą danych
        $con->close();
    ?>