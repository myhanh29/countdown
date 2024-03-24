<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'database.php';
require_once 'user.php';
class setappointment {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }
    /*public function takeuserid() {
    $sql = "SELECT MAX(ID) FROM user";
    $result = $this->conn->query($sql);

    if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
        //return $row['id'];
        echo $row['id'];
    } else {
        return 0;
    }
}*/
    
    public function appointment($terminname,$description,$datetime,$isactive,$userid)
    {
        $sql = "INSERT INTO appointment (name, description, date, is_active, userid)
    VALUES ('$terminname','$description','$datetime','$isactive'-'0','$userid')";
        if ($this->conn->query($sql) === TRUE) {
            header("Location: index.php");
            return 1;
            
        } else {
            return 0;
        }
    }
}
