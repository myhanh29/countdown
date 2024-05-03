<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class createadmin {

    public function addadmin($firstname, $lastname, $email, $password, $adminrole) {
        //Datei config und database.php hinzufügen 
        require '../config.php';
        require_once '../classes/database.php';
        $db = new database();
//Funktion addadmin aus database.php verwenden 
        $db->addadmin('user', $firstname, $lastname, $email, $password, $adminrole);
        //Zurück zur offiziellen Seite führen, auf der alle Konfigurationen, Datenbanken und Tabellen erstellt werden 
        header("Location: ../index.php");
        exit;
    }
}
