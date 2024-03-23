<?php

class login extends controller {

    public function user_login() {

        if (isset($_POST['email']) && isset($_POST['password'])) {

            $password = $_REQUEST['password'];
            $password=md5($password);
            $email = $_REQUEST['email'];
            
            $user = new user();
            $user->login($password, $email);
            
        }
    }

   public function user_logout() {
        $user = new user();
        $user->logout();
    }
}

$loginController = new login();

// Check if the logout action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $loginController->user_logout();
}



    