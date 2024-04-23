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
            //Schützen das Passwort bei MD5
            $password = md5($password);
            $controller = new Controller();

            $this->databaseConn = $controller->connection; // Verbinden mit dem Datenbank
            $this->databaseConn->add('user', $firstname, $lastname, $email, $password);
            //Nach erfolgreicher Registierung wird Nutzer sich automatisch angemeldet
            $user = new user();
            //Nutzen $_POST['password'], denn das Password wird in der Funktion Login in Klasse user mit MD5 umgewandelt
            $user->login($_POST['password'], $email);
        }
    }
}
