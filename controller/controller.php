<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
class controller{
    public $databaseConn;
    public $connection;
    public function __construct(){
        $db = new database();
        $this->connection = $db;
        $this->databaseConn = $db->conn;
    }

    public function default(){
        
    }
    public function query($sql) {
        return $this->connection->query($sql);
    }
}
