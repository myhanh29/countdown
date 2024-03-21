<?php

class database {

    public $conn;

    public function __construct() {
        $this->conn = $this->connect();
    }

    public function connect() {
        $servername = DBSERVER;
        $username = DBUSER;
        $passwordword = DBPASS;
        $database = DBNAME;

// Create connection
        $conn = new mysqli($servername, $username, $passwordword, $database);

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
            echo "Error creating database: " . $this->error;
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
                echo "Table $tableName created successfully";
            } else {
                echo "Error creating table: " . $this->conn->error;
            }
        } else {
            echo "Table $tableName already exists";
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
                echo "Table $tableName created successfully";
            } else {
                echo "Error creating table: " . $this->conn->error;
            }
        } else {
            echo "Table $tableName already exists";
        }
    }

    public function add($tableName, $firstname, $lastname, $email, $passwordword) {
        $sql = "INSERT INTO $tableName (firstname, lastname, email,PASSWORD)
    VALUES ('$firstname','$lastname','$email','$passwordword')";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
}
