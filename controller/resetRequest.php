
<?php

require_once 'classes/sentmail.php';
require_once 'classes/database.php';

class resetRequest extends controller {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

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
            $mailSender->setSubject('Your password reset link');
            $mailSender->setBody("<h1>You requested a password reset </h1>"
                    . "Click <a href='$url'> this link</a> to do so");
            $mailSender->setAltBody('This is the body in plain text for non-HTML mail clients');
            $mailSender->sendMail();
        }
    }

    
}
