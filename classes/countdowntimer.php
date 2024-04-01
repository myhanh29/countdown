<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'database.php';

class countdowntimer {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function countdown($userid) {
        $appointments = array();
// Select database
        mysqli_select_db($this->conn, "countdown") or die(mysqli_error());
// SQL query
        $strSQL = "SELECT id, name, description, date FROM appointment WHERE is_active='1' AND userid='$userid'";

// Execute the query (the recordset $rs contains the result)
        $rs = mysqli_query($this->conn, $strSQL);

        while ($row = mysqli_fetch_array($rs)) {
            $appointments[] = $row;
        }

        return $appointments;
    }
}
