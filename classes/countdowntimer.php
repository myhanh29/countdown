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
        $admincheck = "SELECT adminrole FROM user WHERE id='$userid'";
        $admin_query = mysqli_query($this->conn, $admincheck);

        if ($admin_query && mysqli_num_rows($admin_query) > 0) {
            $adminrow = mysqli_fetch_assoc($admin_query);
            $adminrole = $adminrow['adminrole'];

            if ($adminrole == 0 || $adminrole == Null) {
                $strSQL = "SELECT id, name, description, date FROM appointment WHERE is_active='1' AND userid='$userid'";
            } else if ($adminrole == 1) {
                $strSQL = "SELECT id, name, description, date FROM appointment WHERE is_active='1'";
            }

        }
// Execute the query (the recordset $rs contains the result)
            $rs = mysqli_query($this->conn, $strSQL);

            while ($row = mysqli_fetch_array($rs)) {
                $appointments[] = $row;
            }

            return $appointments;
        }
    }
    