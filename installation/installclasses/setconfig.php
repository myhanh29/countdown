<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class setconfig {

    private $dbserver;
    private $dbuser;
    private $dbpass;
    private $dbname;
   //Definieren alle Informationen für config, um die Funktion __construct zu erstellen
    public function __construct($dbserver, $dbuser, $dbpass, $dbname) {
        $this->dbserver = $dbserver;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;
        $this->conn = $this->connect();
    }
//Ausfüllen der Konfiguration nach Benutzereingaben
    public function fillConfig() {
        $configContent = " ";
        $configContent .= "define(\"DBSERVER\", \"$this->dbserver\");\n";
        $configContent .= "define(\"DBUSER\", \"$this->dbuser\");\n";
        $configContent .= "define(\"DBPASS\", \"$this->dbpass\");\n";
        $configContent .= "define(\"DBNAME\", \"$this->dbname\");\n";

        $file = '../config.php';
        file_put_contents($file, '<?php' . $configContent, LOCK_EX);
    }


//Mit der Datenbank verbinden
    public function connect() {
        $servername =  $this->dbserver;
        $username = $this->dbuser;
        $password = $this->dbpass;

// Verbindung herstellen
        $conn = new mysqli($servername, $username, $password);

// Verbindung prüfen
        if ($conn->connect_error) {
            return null;
        }
        return $conn;
    }
//datenbank erstellen in sql
    public function createDatabase($databaseName) {
        $sql = "CREATE DATABASE IF NOT EXISTS $databaseName;";

        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            echo "Fehler beim Erstellen der Datenbank: " . $this->conn->error;
            return 0;
        }
    }
//Tabellen im Datenbank erstellen
    public function createtables() {
      require_once '../config.php';
      require_once '../classes/database.php';
      // Nếu config đã được điền, thực hiện kết nối cơ sở dữ liệu và tạo bảng
      $db = new database();
      $db->createTable('user');
      $db->createTable1('appointment');
      $db->createTable2('resetPassword');

      // Chuyển hướng người dùng để tạo tài khoản admin sau khi hoàn thành
      header("Location: install.php?page=setadmin&event=user_createadmin");
      exit;
      } 
}
