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

    public function appointment($terminname, $description, $datetime_star, $isactive, $userid,$datetime_end, $priority) {
        $sql = "INSERT INTO appointment (name, description, date_star, is_active, userid, date_end, priority)
    VALUES ('$terminname','$description','$datetime_star','$isactive'-'0','$userid','$datetime_end','$priority')";
       
        if ($this->conn->query($sql) === TRUE) {
            header("Location: index.php?page=home&event=user_countdown");
            return 1;
        } else {
            return 0;
        }
    }

    public function appointmentlist($userid) {
        $appointments = array();
// Select database
        mysqli_select_db($this->conn, "countdown") or die(mysqli_error());
        
// SQL query
        $admincheck = "SELECT adminrole FROM user WHERE id='$userid'";
        $admin_query = mysqli_query($this->conn, $admincheck);

        if ($admin_query && mysqli_num_rows($admin_query) > 0) {
            $adminrow = mysqli_fetch_assoc($admin_query);
            $adminrole = $adminrow['adminrole'];

            if ($adminrole == 0||$adminrole == Null) {
        $strSQL = "SELECT appointment.*, user.firstname FROM appointment INNER JOIN user ON appointment.userid=user.id WHERE user.id='$userid'";
            }
            else if($adminrole == 1)
            {
                  $strSQL = "SELECT appointment.*, user.firstname FROM appointment INNER JOIN user ON appointment.userid=user.id";
            }
        }
// Execute the query (the recordset $rs contains the result)
        $rs = mysqli_query($this->conn, $strSQL);
        while ($row = mysqli_fetch_array($rs)) {
            $appointments[] = $row;
        }
        return $appointments;
    }

    //Pruefen der Ersteller des Termines
    public function checkappointment($userid, $id) {
        $admincheck = "SELECT adminrole FROM user WHERE id='$userid'";
        $admin_query = mysqli_query($this->conn, $admincheck);

        if ($admin_query && mysqli_num_rows($admin_query) > 0) {
            $adminrow = mysqli_fetch_assoc($admin_query);
            $adminrole = $adminrow['adminrole'];

            if ($adminrole == 0) {
                $query = "SELECT * FROM appointment WHERE id='$id' AND userid='$userid'";

                $checkU = mysqli_query($this->conn, $query)
                        or die(mysqli_error($this->conn))
                ;

                if (mysqli_num_rows($checkU) == 0) {

                    header("Location: index.php?page=appointmentlist&event=user_appointmentlist");
                    exit;
                }
            }
        }
    }

    public function editappointment($terminname2, $description2, $datetime_star2,$datetime_end2, $isactive2, $id, $priority2) {
        $query = "UPDATE appointment SET name='$terminname2', description='$description2', date_star='$datetime_star2', date_end='$datetime_end2',is_active=('$isactive2'-'0'), priority='$priority2' WHERE id='$id'";
        $query_run = mysqli_query($this->conn, $query);
        if ($query_run) {
            $_SESSION['announcement'] = "Termine aktualisiert";
            header('Location: index.php?page=appointmentlist&event=user_appointmentlist');
        } else {
            $_SESSION['announcement'] = "Etwas ist schief gelaufen!";
        }
    }

    public function deleteappointment($id) {
       
        $sql = "DELETE FROM appointment WHERE id='$id' ";
        if ($this->conn->query($sql) === TRUE) {
            header("Location: index.php?page=appointmentlist&event=user_appointmentlist");
        } else {
            echo "Fehler beim Löschen eines Datensatzes: " . $this->conn->error;
        }

        $this->conn->close();
    }
}
