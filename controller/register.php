<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class register extends controller {

    function user_register() {

        //$database->conn->select_db(DBNAME);
        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password= md5($password);
            $this->databaseConn->add('user', $firstname, $lastname, $email, $password);
        
            session_start();
            $_SESSION["user"]['email'] = $email; 
            $_SESSION["user"]['password'] = $password;

            header("Location:index.php");
            exit();
            
        }
    }
}

$controller = new Controller();
// Instantiate register and pass the database connection
$register = new Register();
$register->databaseConn = $controller->connection; // Access the database connection property
// Call the user_register method
$register->user_register();
