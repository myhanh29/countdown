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

    public function appointment($terminname, $description, $datetime, $isactive, $userid) {
        $sql = "INSERT INTO appointment (name, description, date, is_active, userid)
    VALUES ('$terminname','$description','$datetime','$isactive'-'0','$userid')";
        if ($this->conn->query($sql) === TRUE) {
            header("Location: index.php");
            return 1;
        } else {
            return 0;
        }
    }

    public function appointmentlist($userid) {

// Select database
        mysqli_select_db($this->conn, "countdown") or die(mysqli_error());
// SQL query
        $strSQL = "SELECT appointment.*, user.firstname FROM appointment INNER JOIN user ON appointment.userid=user.id WHERE user.id='$userid'";

// Execute the query (the recordset $rs contains the result)
        $rs = mysqli_query($this->conn, $strSQL);

        print "<div style='display: flex; justify-content: center;'>";
        print "<table style=\"margin-top:50px; text-align: center;\" border='1' cellspacing='10' width='80%' bgcolor='#E8E8E8'> ";

        print "<tr>";
        print" <td width=100 style='font-weight: bold;'>Id</td> 
  <td width=100 style='font-weight: bold;'>Name</td> 
  <td width=100 style='font-weight: bold;'>Beschreibung</td> 
  <td width=100 style='font-weight: bold;'>Datum</td> 
  <td width=100 style='font-weight: bold;'>Aktiver Status</td> 
  <td width=100 style='font-weight: bold;'>Benutzername</td> 
  <td width=100 style='font-weight: bold;'>Aktion</td> 
  </tr>";
        while ($row = mysqli_fetch_array($rs)) {
            if ($row['is_active'] == '1') {
                $row['is_active'] = '&checkmark;';
            } else {
                $row['is_active'] = ' ';
            }

            $date = date("m/d/Y H:i:s", strtotime($row['date']));
            print "<tr>";
            print "<td>" . $row['id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['description'] . "</td>";
            print "<td>" . $date . "</td>";
            print "<td>" . $row['is_active'] . "</td>";
            print "<td>" . $row['firstname'] . "</td>";
            print "<td>";
            print "<a href='index.php?page=appointment&event=user_editappointment&id=" . $row['id'] . "' style='background-color: #fff2e6;border: 1px solid black; text-decoration: none; color: black;'>Bearbeiten</a>";
            print " ";
            print "<a href='' style='background-color: #fff2e6;border: 1px solid black; text-decoration: none; color: black;'>Loeschen</a>";
            print "</td>";
            print "</tr>";
        }
        print "</table>";
    }

    public function editappointment($terminname2, $description2, $datetime2, $isactive2, $id) {
       
        $query = "UPDATE appointment SET name='$terminname2', description='$description2', date='$datetime2', is_active=('$isactive2'-'0') WHERE id='$id'";
        $query_run = mysqli_query($this->conn, $query);
        if ($query_run) {
            $_SESSION['announcement'] = "Termine aktualisiert";
            header('Location: index.php?page=appointmentlist&event=user_appointmentlist');
        } else {
            $_SESSION['announcement'] = "Etwas ist schief gelaufen!";
            
        }
    }

}
