<?php
require_once 'database.php';
class user{
    
    public $conn;

    public function __construct() {
          $db = new Database();
        $this->conn = $db->connect();
    }

    
    public function login($password,$email)
    {
        $disallowed_values = array('"', "'");
            $validPassword = true;
          
            foreach ($disallowed_values as $value) {
                if (strpos($password, $value) !== false) {
                    $validPassword = false;
                      break;
                }
            }
           if ($validPassword == TRUE) {
                $password= md5($password);
                $query = "SELECT email, password FROM user WHERE email = '" . $email . "' AND password ='$password'";
               
                $checkU = mysqli_query($this->conn, $query)
                        or die(mysqli_error($this->conn))
                ;

                if (mysqli_num_rows($checkU) >0) {
 //echo "login success";
 
                    header("Location: index.php");
                    $_SESSION["email"] = $email;
                }
            
    }
} 
  function logout() {
// Initialize the session.
// Unset all of the session variables.
        unset($_SESSION["email"]);

// Finally, destroy the session.    
// Include URL for Login page to login again.
        header("Location: index.php?section=home");
        exit();
    }
    
}
