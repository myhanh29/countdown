<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'database.php';

class createuserlist {

    public $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function userlist($adminrole) {
        if ($adminrole == 1) {
            $users = array();

            $strSQL = "SELECT * FROM user";

// Execute the query (the recordset $rs contains the result)
            $rs = mysqli_query($this->conn, $strSQL);
            while ($row = mysqli_fetch_array($rs)) {
                $users[] = $row;
            }
            return $users;
        }
    }
    
    public function edituser($firstname2, $lastname2, $email2,$password2, $adminrole2, $id) {
        $query = "UPDATE user SET firstname='$firstname2', lastname=' $lastname2', email='$email2', PASSWORD='$password2',adminrole=('$adminrole2'-'0') WHERE id='$id'";
        $query_run = mysqli_query($this->conn, $query);
        if ($query_run) {
            $_SESSION['announcement'] = "Benutzerdaten aktualisiert";
            header('Location: index.php?page=userlist&event=admin_userlist');
        } else {
            $_SESSION['announcement'] = "Etwas ist schief gelaufen!";
        }
    }
    
    public function deleteuser($id) {
       
        $sql = "DELETE FROM user WHERE id='$id' ";
        if ($this->conn->query($sql) === TRUE) {
            header("Location: index.php?page=userlist&event=admin_userlist");
        } else {
            echo "Fehler beim Löschen eines Datensatzes: " . $this->conn->error;
        }

        $this->conn->close();
    }
}
