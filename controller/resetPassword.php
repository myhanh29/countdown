<?php

require_once 'classes/database.php';

class resetPassword extends controller {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function user_newPassword() {
        if (!isset($_GET["code"])) {
            exit("Seite nicht finden können");
        }
        $code = $_GET["code"];
        $getEmailQuery = mysqli_query($this->conn, "SELECT email FROM resetpassword WHERE code='$code'");
        if (mysqli_num_rows($getEmailQuery) == 0) {
            exit("Seite nicht finden können");
        }

        if (isset($_POST["password"])) {
            $pw = $_POST["password"];
            $pw = md5($pw);

            $row = mysqli_fetch_array($getEmailQuery);
            $email = $row["email"];
            $query = mysqli_query($this->conn, "UPDATE user SET PASSWORD='$pw' WHERE email='$email'");

            if ($query) {
                $query = mysqli_query($this->conn, "DELETE FROM resetpassword WHERE code='$code'");
                session_start();
                $_SESSION['announcement'] = "Passwort geändert";
                header("Location: index.php");

                exit();
            } else {
                
                $_SESSION['announcement'] = "Etwas ist schief gelaufen!";
                header("Location: index.php");

                exit();
            }
        }
    }
}
