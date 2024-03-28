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

// Create connection
        $conn = new mysqli($servername, $username, $password, $database);

// Check connection
        if ($conn->connect_error) {
            return null;
        }
        return $conn;
    }

    public function createDatabase($databaseName) {
        $sql = "CREATE DATABASE $databaseName";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            echo "Fehler beim Erstellen der Datenbank: " . $this->error;
            return 0;
        }
    }

    public function createTable($tableName) {
        $checkTableExistsQuery = "SHOW TABLES LIKE '$tableName'";
        $result = $this->conn->query($checkTableExistsQuery);

        if ($result->num_rows == 0) {
            $sql = "CREATE TABLE $tableName (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50)
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

    public function createTable1($tableName) {
        $checkTableExistsQuery = "SHOW TABLES LIKE '$tableName'";
        $result = $this->conn->query($checkTableExistsQuery);

        if ($result->num_rows == 0) {
            $sql = "CREATE TABLE $tableName (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
reg_date DATETIME
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

    public function add($tableName, $firstname, $lastname, $email, $password) {
        $sql = "INSERT INTO $tableName (firstname, lastname, email,PASSWORD)
    VALUES ('$firstname','$lastname','$email','$password')";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
}
