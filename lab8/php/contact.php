<?php
    function PokazKontakt() {
        echo '
        <form action="contact.php" method="post">
            <label for="temat">Subject:</label>
            <input type="text" name="temat" required><br>
            <label for="tresc">Message:</label>
            <textarea name="tresc" rows="4" required></textarea><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <input type="submit" value="Submit">
        </form>';
    }

    function WyslijMailKontakt($odbiorca) {
        if(empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
            echo '[nie wypelniles pola]';
            echo PokazKontakt();
        } else {
            $mail['subject'] = $_POST['temat'];
            $mail['body'] = $_POST['tresc'];
            $mail['sender'] = $_POST['email'];
            $mail['recipient'] = $odbiorca;

            $header = "From: Formularz kontaktowy <".$mail['sender'].">\n";
            $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
            $header .= "X-Sender: <".$mail['sender'].">\n";
            $header .= "X-Mailer: PRapWWW mail 1.2\n";
            $header .= "X-Priority: 3\n";
            $header .= "Return-Path: <".$mail['sender'].">\n";

            mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

            echo '[wiadomosc_wyslana]';
        }
    }

    function PrzypomnijHaslo($adminEmail) {
        $newPassword = generateRandomPassword(); 
        $mail['subject'] = 'Password Reminder';
        $mail['body'] = 'Your new password is: ' . $newPassword;
        $mail['sender'] = 'example@example.pl';
        $mail['recipient'] = $adminEmail;

        $header = "From: Password Reminder <".$mail['sender'].">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <".$mail['sender'].">\n";
        $header .= "X-Mailer: PRapWWW mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <".$mail['sender'].">\n";

        mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

        echo '[mail_sent]';
    }
?>
