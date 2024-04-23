<?php

class login extends controller {

    public function user_login() {

        if (isset($_POST['email']) && isset($_POST['password'])) {

            $password = $_REQUEST['password'];
            
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





    