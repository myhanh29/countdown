<?php

class login extends controller {

public function user_login() {

if (isset($_POST['email']) && isset($_POST['password'])) {

$pass = $_REQUEST['password'];
$email = $_REQUEST['email'];
$disallowed_values = array('"', "'");
$validPassword = true;

foreach ($disallowed_values as $value) {
if (strpos($pass, $value) !== false) {
$validPassword = false;
break;
}
}

if ($validPassword== TRUE) {
$query = "SELECT email, password FROM visiter WHERE email = '" . $email . "' AND password ='$pass'";
$checkU = mysqli_query($this->databaseConn, $query)
or die(mysqli_error($this->databaseConn))
;

// echo $query . "<br>";

if (mysqli_num_rows($checkU) > 0) {
//   echo "login success";
//   
header("Location: index.php");
$_SESSION["email"] = $email;
}
}
}
}

function user_logout(){
// Initialize the session.
// Unset all of the session variables.
unset($_SESSION["email"]);

// Finally, destroy the session.    

// Include URL for Login page to login again.
header("Location: index.php?section=home");
exit();
}

}
$loginController = new login();

// Check if the logout action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $loginController->user_logout();
}



    