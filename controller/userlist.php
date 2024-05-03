<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/createuserlist.php';
/**
 * Diese Methode ruft die Benutzerliste für den Administrator ab.
 * Nur Benutzer mit Administratorberechtigungen können darauf zugreifen.
 * 
 * @return array Die Benutzerliste
 */
class userlist {

    public function admin_userlist() {
        $adminrole = $_SESSION["user"]["adminrole"];
        if ($adminrole == 1) {
            $createuserlist = new createuserlist();
            $users = $createuserlist->userlist($adminrole);
        }
        return $users;
    }
/**
 * Diese Methode löscht einen Benutzer aus der Benutzerliste.
 */
    public function admin_deleteuser() {
        $createuserlist = new createuserlist();
        $createuserlist->deleteuser($_GET['id']);
    }
/**
 * Diese Methode bearbeitet die Daten eines Benutzers.
 * Sie überprüft, ob Formulardaten gesendet wurden, und aktualisiert entsprechend die Benutzerdaten.
 */
    public function admin_edituser() {
 
        if (isset($_POST['edit_firstname']) || isset($_POST['edit_lastname']) || isset($_POST['edit_email']) || isset($_POST['edit_password']) || isset($_POST['edit_adminrole'])) {
            $id = $_POST['id'];
            //  $userid = $_SESSION['user']['id'];

            $firstname2 = $_POST['edit_firstname'];
            $lastname2 = $_POST['edit_lastname'];
            $email2 = $_POST['edit_email'];
            $password2 = md5($_POST['edit_password']);

            $adminrole2 = $_POST['edit_adminrole'];
            $createuserlist = new createuserlist();
            $createuserlist->edituser($firstname2, $lastname2, $email2, $password2, $adminrole2, $id);
        }
    }
}
