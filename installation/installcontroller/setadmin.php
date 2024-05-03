<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once '../classes/database.php';
require_once 'installclasses/createadmin.php';
class setadmin{
    public function user_createadmin(){
    
          if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
        
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            //Schützen das Passwort bei MD5
            $password = md5($password);
            $adminrole='1';
            //Funktion in der creatadmin-Klasse verwenden 
            $createadmin= new createadmin();
            $createadmin->addadmin($firstname, $lastname, $email, $password, $adminrole);
            
          }
    }
}