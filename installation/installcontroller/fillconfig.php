<?php

require_once 'installclasses/setconfig.php';

class fillconfig {

    public function user_fillconfig() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Daten aus dem Formular holen
            $dbserver = $_POST['dbserver'];
            $dbuser = $_POST['dbuser'];
            $dbpass = $_POST['dbpass'];
            $dbname = $_POST['dbname'];

            //Verwenden Sie die Funktion fillConfig() in setconfig.php, um die Datei config.php zu erstellen
            $setconfig = new setconfig($dbserver, $dbuser, $dbpass, $dbname);
            $setconfig->fillConfig();
            // Wenn die Konfiguration ausgefüllt wurde, rufen Sie die Methode createDatabase() auf.
            $setconfig->createDatabase($dbname);
            $setconfig->createtables();
        }
    }
}
