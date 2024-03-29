<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'classes/database.php';
require_once 'classes/setappointment.php';

class appointment {

    public function user_appointment() {

        if (isset($_POST['terminname']) && isset($_POST['description']) && isset($_POST['datetime']) && isset($_POST['isactive'])) {
            $email = $_SESSION['user']['email'];
            $userid = $_SESSION['user']['id'];

            $terminname = $_REQUEST['terminname'];
            $description = $_REQUEST['description'];
            $datetime = $_REQUEST['datetime'];
            $isactive = $_POST['isactive'];

            $setappointment = new setappointment();

            $setappointment->appointment($terminname, $description, $datetime, $isactive, $userid);
        }
    }

    public function user_editappointment() {

        if ($_SESSION['user']['id']) {

            if (isset($_POST['edit_terminname']) || isset($_POST['edit_description']) || isset($_POST['edit_datetime']) || isset($_POST['edit_isactive'])) {


                $id = $_POST['id'];
                $terminname2 = $_POST['edit_terminname'];
                $description2 = $_POST['edit_description'];
                $datetime2 = $_POST['edit_datetime'];
                $isactive2 = $_POST['edit_isactive'];

                $setappointment = new setappointment();
                $setappointment->editappointment($terminname2, $description2, $datetime2, $isactive2, $id);
            }
        }
    }
    public function user_deleteappointment() {
        $id = $_GET['id'];
        
        $setappointment = new setappointment();
        $setappointment->deleteappointment($id);
    }
}
