<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'database.php';

class countdowntimer {

    public $conn;

    public function __construct() {
         // Verbindung zur Datenbank herstellen
        $db = new Database();
        $this->conn = $db->connect();
    }
// Countdown-Timer für Termine basierend auf der Benutzerrolle abrufen
    public function countdown($userid) {
        $appointments = array();
// Datenbank auswählen
        mysqli_select_db($this->conn, DBNAME) or die(mysqli_error());
 // SQL-Abfrage für die Administratorrolle des Benutzers
        $admincheck = "SELECT adminrole FROM user WHERE id='$userid'";
        $admin_query = mysqli_query($this->conn, $admincheck);
     
        if ($admin_query!== false && mysqli_num_rows($admin_query) > 0) {
            $adminrow = mysqli_fetch_assoc($admin_query);
            $adminrole = $adminrow['adminrole'];
// Abfrage für Termine basierend auf der Benutzerrolle
            if ($adminrole == '0' || $adminrole == Null) { 
                 // SQL-Abfrage für Termine des Benutzers
                $strSQL = "SELECT id, name, description, date_star FROM appointment WHERE is_active='1' AND userid='$userid'";
            } else if ($adminrole == '1') {
                 // SQL-Abfrage für alle Termine
                $strSQL = "SELECT id, name, description, date_star FROM appointment WHERE is_active='1'";
                
            }

        }
// Die Abfrage ausführen und das Ergebnis verarbeiten
            $rs = mysqli_query($this->conn, $strSQL);

            while ($row = mysqli_fetch_array($rs)) {
                $appointments[] = $row;
            }

            return $appointments;
        }
    }
    