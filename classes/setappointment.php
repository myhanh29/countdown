<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'database.php';
require_once 'user.php';
class sentappointment {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }
    
    public function takeuserid($firstname) {
        $sql="SELECT id FROM user WHERE firstname=$firstname";
        
        if ($this->conn->query($sql) === TRUE) {
            return $userid=$sql;
        } else {
            return 0;
        }  
        
    }
    public function appointment($firstname,$description,$datetime,$isactive,$userid)
    {
        $sql = "INSERT INTO appointment (firstname, description, date, is active, userid)
    VALUES ('$firstname','$description','$datetime','$isactive','$userid')";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
}
