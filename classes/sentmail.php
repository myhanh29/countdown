<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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

    public function setFrom($address, $name) {
        $this->mail->setFrom($address, $name);
    }

    public function addRecipient($address) {
        $this->mail->addAddress($address);
    }

    public function addReplyTo($address, $name) {
        $this->mail->addReplyTo($address, $name);
    }

    public function addAttachment($path, $name = '') {
        $this->mail->addAttachment($path, $name);
    }

    public function setHTMLFormat($isHTML) {
        $this->mail->isHTML($isHTML);
    }

    public function setSubject($subject) {
        $this->mail->Subject = $subject;
    }

    public function setBody($body) {
        $this->mail->Body = $body;
    }

    public function setAltBody($altBody) {
        $this->mail->AltBody = $altBody;
    }

    public function sendMail() {
        try {
            $this->mail->send();
            session_start();

// Set the announcement message
            $_SESSION['announcement'] = "Reset password link has been sent to your email!";

// Redirect to index.php
            header("Location: index.php");
        } catch (Exception $e) {
            session_start();
            $_SESSION['announcement'] = "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            header("Location: index.php");
        }
        exit();
    }
}
