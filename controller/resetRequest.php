
<?php

require_once 'classes/sentmail.php';
require_once 'classes/database.php';

class resetRequest extends controller {
// Diese Variable speichert die Verbindung zur Datenbank.
    public $conn;
// Der Konstruktor initialisiert die Verbindung zur Datenbank.
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }
 /* Diese Methode setzt das Passwort eines Benutzers zurück.
 * Wenn die E-Mail des Benutzers im POST-Array vorhanden ist, wird ein Zurücksetzungslink per E-Mail gesendet.
 */
    public function user_reset() {
        if (isset($_POST['email'])) {
            $emailTo = $_POST['email'];
            /*$emailcheck = mysqli_query($this->conn, "SELECT email FROM user");*/
            $code = uniqid(true);
            $query = mysqli_query($this->conn, "INSERT INTO resetpassword(code,email)VALUES ('$code','$emailTo')");
            if (!$query) {
                exit("Error");
            }
            $url= "http://".$_SERVER["HTTP_HOST"]. dirname($_SERVER["PHP_SELF"])."/index.php?page=resetPassword&event=user_newPassword&code=$code";
            $mailSender = new sentmail();
            $mailSender->setFrom('hien@wystem.de', 'Count Down');
            $mailSender->addRecipient($emailTo);
            $mailSender->addReplyTo('no-reply@wystem.de', 'No reply');
            $mailSender->setHTMLFormat(true);
            $mailSender->setSubject('Ihr Link zum Zuruecksetzen des Passworts');
            $mailSender->setBody("<h1>Sie haben ein neues Passwort angefordert </h1>"
                    . "Klicken Sie auf <a href='$url'> this link</a>, um dies zu tun");
            $mailSender->setAltBody('Dies ist der Textkörper im Klartext für Nicht-HTML-Mail-Clients');
            $mailSender->sendMail();
        }
    }

    
}
