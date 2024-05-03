<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Informationen für den Versand der E-Mail zum Zurücksetzen des Passworts
define("HOST","smtp.strato.de");
define("SMTPAUTH",true);
define("MAILUSERNAME","hien@wystem.de");
define("MAILPASSWORD","thuhiennguyen123");
define("SMTPSECURE","tls");
define("PORT",587);
class sentmail {

    private $mail;

    public function __construct() {

        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = HOST;
        $this->mail->Port = PORT;
        $this->mail->SMTPAuth = SMTPAUTH;
        $this->mail->Username = MAILUSERNAME;
        $this->mail->Password = MAILPASSWORD;
        $this->mail->SMTPSecure = SMTPSECURE;
    }
  // Absender festlegen
    public function setFrom($address, $name) {
        $this->mail->setFrom($address, $name);
    }
   // Empfänger hinzufügen
    public function addRecipient($address) {
        $this->mail->addAddress($address);
    }
// Antwortadresse festlegen
    public function addReplyTo($address, $name) {
        $this->mail->addReplyTo($address, $name);
    }
  // Anhang hinzufügen
    public function addAttachment($path, $name = '') {
        $this->mail->addAttachment($path, $name);
    }
 // HTML-Format festlegen
    public function setHTMLFormat($isHTML) {
        $this->mail->isHTML($isHTML);
    }
 // Betreff festlegen
    public function setSubject($subject) {
        $this->mail->Subject = $subject;
    }
// E-Mail-Inhalt festlegen
    public function setBody($body) {
        $this->mail->Body = $body;
    }
   // Alternativen Textkörper festlegen
    public function setAltBody($altBody) {
        $this->mail->AltBody = $altBody;
    }
  // E-Mail senden
    public function sendMail() {
        try {
             // E-Mail senden
            $this->mail->send();
            session_start();

 // Ankündigungsnachricht festlegen
            $_SESSION['announcement'] = "Der Link zur Aenderung des Passworts wurde an Ihre E-Mail gesendet!";

 // Zurück zu index.php umleiten
            header("Location: index.php");
        } catch (Exception $e) {
              // Fehlerbehandlung bei fehlgeschlagenem Senden der E-Mail
            $_SESSION['announcement'] = "Nachricht konnte nicht gesendet werden. Mailer-Fehler: {$this->mail->ErrorInfo}";
            header("Location: index.php");
        }
        exit();
    }
}
