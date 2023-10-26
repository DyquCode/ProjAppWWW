<?php
    $nr_indeksu = '164366';
    $nrGrupy = '2isi';
    echo 'Bartłomiej Dyk '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
    
    echo 'Zastosowanie metody include() i require_once()<br />';

    include('test.php'); #Jeśli plik istnieje, zostanie dołączony
    echo ''.$color.' '.$item.'<br /><br />';

    require_once('test2.php'); #Jeśli plik istnieje, zostaje dołączony tylko raz
    echo ''.$color2.' '.$fruit.'<br /><br />';


    echo 'Zastosowanie warunków if, else, elseif<br/>';

    $liczba = 5;

    if ($liczba < 3) {
        echo "Liczba jest mniejsza od 3.";
    } elseif ($liczba === 3) {
        echo "Liczba jest równa 3.";
    } else {
        echo "Liczba jest większa od 3.";
    }

    echo "<br>";

    echo '<br>Switch<br/>';
    $ocena = '5';

    switch ($ocena) {
        case '6':
            echo "Świetna ocena!";
            break;
        case '5':
            echo "Dobra ocena.";
            break;
        default:
            echo "Ocena nieznana.";
    }

    echo '<br/><br/>Pętle while() i for() <br />';
    echo 'Pętla while()<br/>';
    $x = 0;
    while($x < 4) {
        echo ''.$x.' ';
        $x++;
    }

    echo '<br/><br/>Pętla for()<br/>';
    for($i=0;$i<4;$i++) {
        echo ''.$i.' ';
    }


    echo '<br/><br/>Typy zmiennych $_GET, $_POST, $_SESSION<br/>';
    echo 'Przykład $_GET:<br/>';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $name = $_POST['name'];
        if (empty($name)) {
          echo 'Nazwa jest pusta';
        } else {
          echo 'Nazwa: '.$name;
        }
      }

    echo '<br/><br/>Przykład $_POST:<br/>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        if (empty($name)) {
            echo 'Nazwa jest pusta';
          } else {
            echo 'Nazwa: '.$name;
          }
      }

    echo '<br/><br/>Przykład $_SESSION:<br/>';
    $_SESSION['favcolor'] = 'green';
    $_SESSION['favanimal'] = 'cat';
    echo 'Zmienna sesji favcolor: ' . $_SESSION['favcolor'];
    echo '<br/>Zmienna sesji favanimal: ' . $_SESSION['favanimal'];
?>
