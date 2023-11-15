<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="pl">
<meta name="Author" content="Bartłomiej Dyk">
<title>Filmy o piłce nożnej</title>
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
    </div>
 
    <?php
        $nr_indeksu = '164366';
        $nrGrupy = '2ISI';
        echo 'Autor: Bartłomiej Dyk '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
    ?>

    <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    if ($_GET['idp'] == '') $strona = './html/glowna.html';
    elseif ($_GET['idp'] == 'historia') $strona = './html/historia.html';
    elseif ($_GET['idp'] == 'wspolczesne_zasady') $strona = './html/wspolczesne_zasady.html';
    elseif ($_GET['idp'] == 'zawodnicy') $strona = './html/zawodnicy.html';
    elseif ($_GET['idp'] == 'turnieje_miedzynarodowe') $strona = './html/turnieje_miedzynarodowe.html';
    elseif ($_GET['idp'] == 'galeria') $strona = './html/galeria.html';
    elseif ($_GET['idp'] == 'kontakt') $strona = './html/kontakt.html';
    elseif ($_GET['idp'] == 'filmy') $strona = './html/filmy.html';

    if (!empty($strona) && file_exists($strona)) {
        include($strona);
    } else {
        echo "Strona nie istnieje.";
    }
    ?>