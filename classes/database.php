<?php

class database {

    public $conn;

    public function __construct() {
        $this->conn = $this->connect();
    }

    public function connect() {
        $servername = DBSERVER;
        $username = DBUSER;
        $password = DBPASS;
        $database = DBNAME;

// Verbindung herstellen
        $conn = new mysqli($servername, $username, $password, $database);

// Verbindung prüfen
        if ($conn->connect_error) {
            return null;
        }
        return $conn;
    }
//Datenbank erstellen 
    public function createDatabase($databaseName) {
        $sql = "CREATE DATABASE IF NOT EXISTS $databaseName;";
  
       if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            echo "Fehler beim Erstellen der Datenbank: " . $this->conn->error;
            return 0;
        }
    } 


//Benutzer-Tabelle erstellen 
    public function createTable($tableName) {
        $checkTableExistsQuery = "SHOW TABLES LIKE '$tableName'";
        $result = $this->conn->query($checkTableExistsQuery);

        if ($result->num_rows == 0) {
            $sql = "CREATE TABLE $tableName (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
PASSWORD VARCHAR(255) NOT NULL,
adminrole BIT(64)
)";

            if ($this->conn->query($sql) === TRUE) {
                echo "Tabelle $tableName wurde erfolgreich erstellt";
            } else {
                echo "Fehler beim Erstellen der Datenbank: " . $this->conn->error;
            }
        } else {
            echo "Tabelle $tableName ist bereits vorhanden";
        }
    }
//Tabelle nach ID sortieren
    public function order($tablename) {
        $sql = "SELECT * FROM $tablename ORDER BY id ASC";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            return null;
        }
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
//Tabelle für Termine erstellen
    public function createTable1($tableName) {
        $checkTableExistsQuery = "SHOW TABLES LIKE '$tableName'";
        $result = $this->conn->query($checkTableExistsQuery);

        if ($result->num_rows == 0) {
            $sql = "CREATE TABLE $tableName (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
description LONGTEXT,
date_star DATETIME,
is_active BIT(64),
userid BIGINT(255),
date_end DATETIME,
priority VARCHAR(255)
)";

            if ($this->conn->query($sql) === TRUE) {
                echo "Tabelle $tableName wurde erfolgreich erstellt";
            } else {
                echo "Fehler beim Erstellen der Datenbank: " . $this->conn->error;
            }
        } else {
            echo "Tabelle $tableName ist bereits vorhanden";
        }
    }
//Tabelle zum Zurücksetzen des Passworts erstellen
    public function createTable2($tableName) {
        $checkTableExistsQuery = "SHOW TABLES LIKE '$tableName'";
        $result = $this->conn->query($checkTableExistsQuery);

        if ($result->num_rows == 0) {
            $sql = "CREATE TABLE $tableName (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
code VARCHAR(255),
email VARCHAR(255)
)";

            if ($this->conn->query($sql) === TRUE) {
                echo "Tabelle $tableName wurde erfolgreich erstellt";
            } else {
                echo "Fehler beim Erstellen der Datenbank: " . $this->conn->error;
            }
        } else {
            echo "Tabelle $tableName ist bereits vorhanden";
        }
    }
   //In der user-Tabelle Nutzer hinzufügen
    public function add($tableName, $firstname, $lastname, $email, $password) {
        $sql = "INSERT INTO $tableName (firstname, lastname, email,PASSWORD)
    VALUES ('$firstname','$lastname','$email','$password')";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
    //in der user-Tabelle nur für das Administratorkonto hinzufügen
    public function addadmin($tableName, $firstname, $lastname, $email, $password, $adminrole) {
     
        $sql = "INSERT INTO $tableName (firstname, lastname, email,PASSWORD,adminrole)
    VALUES ('$firstname','$lastname','$email','$password','$adminrole'-'0')";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
}
