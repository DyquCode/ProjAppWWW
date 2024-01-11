-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 11, 2024 at 11:07 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `164366_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`) VALUES
(38, 0, '33'),
(39, 0, 'category2'),
(41, 4, '45'),
(42, 41, 'category1'),
(43, 41, 'category2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'glowna', '<table>\r\n        <tr>\r\n            <td colspan=\"2\">\r\n                <h2>Witaj na mojej stronie o piłce nożnej!</h2>\r\n                <div class=\"image-container\">\r\n                    <img src=\"./img/pilka1.jpg\" alt=\"pilka1\">\r\n                    <img src=\"./img/pilka2.jpg\" alt=\"pilka2\">\r\n                    <img src=\"./img/pilka3.jpg\" alt=\"pilka3\">\r\n                </div>\r\n                <p>To jest moja strona poświęcona mojemu ulubionemu hobby - piłce nożnej. Znajdziesz tutaj wiele informacji o historii piłki nożnej, jej znanych zawodnikach, a także galerię zdjęć.</p>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <div class=\"menu\">\r\n        <a href=\"./html/skrypty.html\" style=\"color: blue;\">Skrypty link</a>\r\n        <a href=\"./html/test_php_form.html\" style=\"color: blue;\">Formularz Php Test</a>\r\n    </div>', 1),
(2, 'historia', '<table>\r\n        <tr>\r\n            <td colspan=\"2\">\r\n                <h2>Historia</h2>\r\n                <div><p>Dawno, dawno temu, ludzie zaczęli grać w grę zwaną \"piłką nożną\". Gra ta była bardzo prosta i polegała na tym, że dwie drużyny próbowały strzelić piłkę do bramki przeciwnika. Pierwsze gry piłki nożnej były rozgrywane na otwartych przestrzeniach, a zawodnicy używali swoich nóg, żeby kopnąć piłkę.\r\n\r\n                    W miarę upływu czasu, piłka nożna stała się coraz bardziej popularna. Zaczęły się tworzyć zasady gry, takie jak zakaz używania rąk (oprócz bramkarzy) i ustalono wymiary boiska. Powstały również pierwsze zespoły i rozgrywki międzynarodowe.\r\n                    \r\n                    W XIX wieku piłka nożna zyskała ogromną popularność w Wielkiej Brytanii, a potem na całym świecie. Zorganizowano pierwsze międzynarodowe mecze, a w 1904 roku powstała FIFA, organizacja zarządzająca piłką nożną na całym świecie.\r\n                    \r\n                    Dzięki piłce nożnej ludzie z różnych krajów mogli współzawodniczyć i budować przyjaźnie. Gra ta stała się jednym z najpopularniejszych sportów na świecie i jest rozgrywana na stadionach przez miliony fanów.\r\n                    \r\n                    Teraz piłka nożna to nie tylko sport, ale także pasja i sposób, aby ludzie łączyli się ze sobą na całym świecie.</p></div>\r\n            </td>\r\n        </tr>\r\n    </table>', 1),
(3, 'wspolczesne_zasady', '<table>\r\n        <tr>\r\n            <td colspan=\"2\">\r\n                <h2>Współczesne zasady piłki nożnej</h2>\r\n                <div class=\"zasady\">\r\n                    <p>\r\n                        <ul>\r\n                            <li>Drużyny: W piłce nożnej grają dwie drużyny, zazwyczaj po 11 zawodników w każdej.</li>\r\n\r\n                            <li>Bramki: Celem gry jest strzelić więcej goli do bramki przeciwnika niż przeciwna drużyna. Bramki są obszarami na obu końcach boiska.</li>\r\n                        \r\n                            <li>Piłka: Gra toczy się za pomocą okrągłej piłki.</li>\r\n                        \r\n                            <li>Rozpoczęcie gry: Mecz rozpoczyna się od rozpoczęcia na środku boiska. Jedna drużyna kopie piłkę, a druga drużyna stara się ją przejąć.</li>\r\n                        \r\n                            <li>Dopuszczalne ręce: Zawodnicy mogą używać rąk tylko wtedy, gdy są bramkarzami, czyli chronią swoją bramkę. Pozostali zawodnicy nie mogą celowo dotykać piłki rękoma.</li>\r\n                        \r\n                            <li>Zasada spalonego: Zawodnik nie może znajdować się na pozycji spalonej, tj. bliżej linii bramkowej przeciwnika niż ostatni obrońca, kiedy piłka jest kopnięta do niego przez partnera z drużyny.</li>\r\n                        \r\n                            <li>Kartki: Sędzia może przyznać zawodnikowi żółtą kartkę za naruszenie zasad lub czerwoną kartkę za poważne naruszenia, co oznacza wykluczenie z gry.</li>\r\n                        \r\n                            <li>Rzuty wolne: Po popełnieniu pewnych przewinień, drużyna przeciwna ma prawo do wykonywania rzutu wolnego, co oznacza, że mogą kopnąć piłkę z miejsca, gdzie wystąpiło przewinienie.</li>\r\n                        \r\n                            <li>Rozpoczęcie lub wznowienie gry: Gra jest wznowiona rzutem rożnym lub rzutem sędziowskim po wyjściu piłki poza linię boiska.</li>\r\n                        \r\n                            <li>Czas gry: Mecz trwa zazwyczaj 90 minut (2 połowy po 45 minut), z dodatkowym czasem w przypadku remisu.</li>\r\n                        </ul>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n    </table>', 1),
(4, 'zawodnicy', '<table>\r\n        <tr>\r\n            <td colspan=\"2\">\r\n                <h2>Znani zawodnicy piłki nożnej</h2>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <div class=\"player\">\r\n                    <img src=\"./img/messi.jpg\" alt=\"Lionel Messi\">\r\n                    <h2>Lionel Messi</h2>\r\n                    <p>Lionel Messi to argentyński piłkarz, uważany za jednego z najlepszych zawodników w historii futbolu. Urodzony 24 czerwca 1987 roku, Messi jest znany z niezwykłego talentu, umiejętności dryblingu, precyzyjnych podań i zdolności strzeleckich. Spędził większość swojej kariery w FC Barcelonie, zdobywając liczne tytuły, w tym Liga Mistrzów, La Liga i Copa del Rey. W 2021 roku przeszedł do Paris Saint-Germain (PSG). Messi wielokrotnie zdobywał nagrody Złotej Piłki, przyznawanej najlepszemu piłkarzowi na świecie, i jest uważany za legendę futbolu.</p>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <div class=\"player\">\r\n                    <img src=\"./img/ronaldo.jpg\" alt=\"Cristiano Ronaldo\">\r\n                    <h2>Cristiano Ronaldo</h2>\r\n                    <p>Cristiano Ronaldo, urodzony 5 lutego 1985 roku na Maderze, to portugalski piłkarz uważany za jednego z najlepszych zawodników w historii futbolu. Jest znany ze swojej siły, szybkości, zdolności strzeleckich i umiejętności gry głową. Ronaldo grał dla wielu prestiżowych klubów, w tym Sporting CP, Manchester United, Real Madryt, Juventus i od 2021 roku ponownie w Manchester United. Jest zdobywcą wielu nagród Złotej Piłki, przyznawanej najlepszemu piłkarzowi na świecie, i ma na swoim koncie liczne tytuły mistrza ligi oraz triumfy w Lidze Mistrzów. Jest także kapitanem reprezentacji Portugalii i jednym z jej czołowych strzelców. Cristiano Ronaldo jest ikoną futbolu i jednym z najbardziej rozpoznawalnych sportowców na świecie.</p>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <div class=\"player\">\r\n                    <img src=\"./img/pele.jpg\" alt=\"Pele\">\r\n                    <h2>Pele</h2>\r\n                    <p>Pelé, czyli Edson Arantes do Nascimento, to brazylijska legenda piłki nożnej urodzona 23 października 1940 roku. Jest uważany za jednego z najlepszych piłkarzy w historii futbolu. Pelé znany jest z niezwykłej techniki, zdolności strzeleckich oraz zdolności do gry głową. Całą swoją klubową karierę spędził w Santos FC w Brazylii oraz New York Cosmos w Stanach Zjednoczonych. W trakcie swojej kariery zdobył trzykrotnie Puchar Świata z reprezentacją Brazylii (1958, 1962 i 1970). Pelé jest również jednym z najskuteczniejszych strzelców w historii piłki nożnej i jest uważany za ikonę tego sportu.</p>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <div class=\"player\">\r\n                    <img src=\"./img/maradona.jpg\" alt=\"Diego Maradona\">\r\n                    <h2>Diego Maradona</h2>\r\n                    <p>Diego Maradona, urodzony 30 października 1960 roku w Argentynie, to jeden z najwybitniejszych piłkarzy w historii futbolu. Zdobywca złotej piłki. Maradona był znany ze swojej niezwykłej techniki, dryblingów i umiejętności strzeleckich. Jego najważniejszymi osiągnięciami było prowadzenie reprezentacji Argentyny do zwycięstwa w Mistrzostwach Świata w 1986 roku, a także udane występy w klubach, takich jak Barcelona i Napoli. Maradona był kontrowersyjną postacią, ale jednocześnie kochanym bohaterem w Argentynie i na całym świecie. Niestety, zmarł 25 listopada 2020 roku. Jego dziedzictwo w piłce nożnej pozostaje niezapomniane.</p>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n                <div class=\"player\">\r\n                    <img src=\"./img/lewandowski.jpg\" alt=\"Robert Lewandowski\">\r\n                    <h2>Robert Lewandowski</h2>\r\n                    <p>Robert Lewandowski to polski piłkarz, urodzony 21 sierpnia 1988 roku. Jest uważany za jednego z najlepszych napastników na świecie. Lewandowski jest znany ze swojej zdolności strzeleckich, szybkości i wszechstronnego umiejętności gry. Rozpoczął swoją karierę w Polsce, a następnie zdobył rozgłos, grając w niemieckim klubie Borussia Dortmund, a obecnie jest gwiazdą Bayern Monachium. Wielokrotnie zdobywał tytuł króla strzelców w różnych ligach i osiągnął sukcesy zarówno na poziomie klubowym, zdobywając Ligę Mistrzów, jak i reprezentacyjnym, reprezentując Polskę na międzynarodowych turniejach. Robert Lewandowski jest uważany za jednego z najlepszych piłkarzy na świecie i stanowi duma polskiego futbolu.</p>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n    </table>', 1),
(5, 'turnieje_miedzynarodowe', '<table>\r\n        <tr>\r\n            <td colspan=\"2\">\r\n                <h2>Turnieje międzynarodowe</h2>\r\n                <p>\r\n                    Turnieje międzynarodowe w piłce nożnej to prestiżowe zawody sportowe, w których reprezentacje narodowe rywalizują ze sobą na arenie międzynarodowej. Najważniejszymi z nich są Mistrzostwa Świata (FIFA World Cup) oraz Mistrzostwa Europy (UEFA Euro), które odbywają się co cztery lata. W tych turniejach drużyny narodowe walczą o tytuł mistrza, a emocje kibiców sięgają zenitu. Oprócz tych dwóch głównych imprez, istnieją również inne, takie jak Puchar Ameryki Południowej, Puchar Narodów Afryki czy Puchar Azji, które przyciągają uwagę fanów futbolu z całego świata. Dla wielu zawodników i kibiców piłki nożnej udział w międzynarodowych turniejach to marzenie i honorowa okazja reprezentowania swojego kraju.\r\n                </p>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n', 1),
(6, 'galeria', '<table>\r\n        <tr>\r\n            <td colspan=\"2\">\r\n                <p>Oto zdjęcia związane z piłką nożną.</p>\r\n\r\n            <div class=\"gallery\">\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/1.jpg\" alt=\"Piłka nożna 1\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/2.jpg\" alt=\"Piłka nożna 2\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/3.jpg\" alt=\"Piłka nożna 3\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/4.jpg\" alt=\"Piłka nożna 4\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/5.jpg\" alt=\"Piłka nożna 5\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/6.jpg\" alt=\"Piłka nożna 6\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/7.png\" alt=\"Piłka nożna 7\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/8.jpg\" alt=\"Piłka nożna 8\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/9.jpg\" alt=\"Piłka nożna 9\">\r\n                </div>\r\n                <div class=\"image\">\r\n                    <img src=\"./img/galeria/10.jpg\" alt=\"Piłka nożna 10\">\r\n                </div>\r\n            </div>\r\n        </tr>\r\n    </table>\r\n', 1),
(7, 'filmy', '<h1>Filmy o piłce nożnej</h1>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/4iLIxtq2Sb4?si=1jdyw0VQO4LNPXFy&amp;start=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/k-pmdNbxPco?si=kcWvenS-gi0JqB2z&amp;start=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/_5kG6CxGjow?si=C_mG6o4MoEW5d8Rk&amp;start=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1),
(8, 'kontakt', '<table>\r\n        <tr>\r\n            <td>\r\n                <h2>Skontaktuj się z nami</h2>\r\n                <p>Skorzystaj z formularza kontaktowego, aby wysłać nam wiadomość.</p>\r\n                <div class=\"contact-form\">\r\n                    <form action=\"mailto:164366@student.uwm.edu.pl\" method=\"post\">\r\n                        Imię: <input type=\"text\" name=\"name\"><br><br>\r\n                        Email: <input type=\"email\" name=\"email\"><br><br>\r\n                        Wiadomość: <textarea name=\"message\"></textarea><br><br>\r\n                        <input type=\"submit\" value=\"Wyślij\">\r\n                    </form>\r\n                </div>\r\n            </td>\r\n        </tr>\r\n    </table>', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expiration_date` date DEFAULT NULL,
  `net_price` decimal(10,2) NOT NULL,
  `vat_rate` decimal(5,2) NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `availability_status` tinyint(1) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `created_at`, `modified_at`, `expiration_date`, `net_price`, `vat_rate`, `available_quantity`, `availability_status`, `category`, `dimensions`, `image_url`) VALUES
(12, 'ertert', '4tr', '2024-01-11 20:28:55', '2024-01-11 20:56:26', NULL, 34.00, 4.00, 3444, 1, 'category1', '', ''),
(13, 'Testrt', 'dgdg', '2024-01-11 20:44:52', '2024-01-11 20:56:34', NULL, 45.00, 3.00, 433, 1, 'category1', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'user', 'user', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
