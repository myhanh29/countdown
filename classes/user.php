<?php

require_once 'database.php';

class user {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function login($password, $email) {
        // Array of disallowed characters in the password
        $disallowed_values = array('"', "'");
        $validPassword = true;
  // Check if the password contains any disallowed characters
        foreach ($disallowed_values as $value) {
            if (strpos($password, $value) !== false) {
                $validPassword = false;
                break;
            }
        }
         // Proceed with login if the password is valid
        if ($validPassword == TRUE) {
            $password = md5($password);
            $query = "SELECT id, email, password,adminrole FROM user WHERE email = '" . $email . "' AND password ='$password'";

            $checkU = mysqli_query($this->conn, $query)
                    or die(mysqli_error($this->conn))
            ;

            if (mysqli_num_rows($checkU) > 0) {
                // Fetch user data from the database
                $row = mysqli_fetch_assoc($checkU);

                // Extract user information
                $userid = $row['id'];
                $adminrole = $row['adminrole'];
                 // Store user information in session variables
                $_SESSION["user"]["adminrole"] = $adminrole;
                $_SESSION["user"]["email"] = $email;
                $_SESSION["user"]["id"] = $userid;
// Redirect to the appointment page after successful login
                header("Location: index.php?page=appointment&event=user_appointment");
            }
        }
    }

    public function logout() {
       // Check if session variables are set and unset them
         if (isset($_SESSION["user"]["email"]) || isset($_SESSION["user"]["id"]) ||  isset($_SESSION["user"]["adminrole"])){
            unset($_SESSION["user"]["email"]);
            unset($_SESSION["user"]["id"]);
            unset($_SESSION["user"]["adminrole"]);
      
 // Redirect to the login page after logout
            header("Location: index.php");
            exit();
        }
    }
}
