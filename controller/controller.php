<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
//Die Controller-Klasse dient dazu, die Verbindung zur Datenbank zu verwalten und allgemeine Datenbankabfragen auszuführen.
class controller{
    public $databaseConn;// Die Verbindungsvariable zur Datenbank
    public $connection;// Eine Instanz der Datenbankklasse für die Verbindung
//Der Konstruktor initialisiert die Datenbankverbindung und speichert sie in der Klasse.
    public function __construct(){
        $db = new database();// Erstellen einer neuen Instanz der Datenbankklasse
        $this->connection = $db;// Speichern der Instanz für die spätere Verwendung
        $this->databaseConn = $db->conn;// Speichern der Verbindungsvariable für direkten Zugriff
    }

    public function default(){
        
    }
      /*
     * Diese Methode führt eine SQL-Abfrage auf der Datenbank aus.
     * @param string $sql Die SQL-Abfrage, die ausgeführt werden soll.
     * @return mixed Das Ergebnis der SQL-Abfrage.
     */
    public function query($sql) {
        return $this->connection->query($sql);
    }
}
