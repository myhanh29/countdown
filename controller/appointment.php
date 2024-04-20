<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'classes/database.php';
require_once 'classes/setappointment.php';

class appointment {

    public function user_appointment() {

        if (isset($_POST['terminname']) && isset($_POST['description']) && isset($_POST['datetime_star'])&& isset($_POST['datetime_end']) && isset($_POST['isactive'])) {
            $email = $_SESSION['user']['email'];
            $userid = $_SESSION['user']['id'];

            $terminname = $_REQUEST['terminname'];
            $description = $_REQUEST['description'];
            $datetime_star = $_REQUEST['datetime_star'];
            $datetime_end = $_REQUEST['datetime_end'];
            $priority = $_REQUEST['priority'];
            $isactive = $_POST['isactive'];

            $setappointment = new setappointment();

            $setappointment->appointment($terminname, $description, $datetime_star, $isactive, $userid,$datetime_end,$priority);
        }
    }

    public function user_editappointment() {

        if (isset($_SESSION['user']['id'])) {
            $setappointment = new setappointment();
            $setappointment->checkappointment($_SESSION['user']['id'], $_GET['id']);
            if (isset($_POST['edit_terminname']) || isset($_POST['edit_description']) || isset($_POST['edit_datetime_star'])|| isset($_POST['edit_datetime_end']) || isset($_POST['edit_isactive'])) {
                $id = $_POST['id'];
                $userid = $_SESSION['user']['id'];

                $terminname2 = $_POST['edit_terminname'];
                $description2 = $_POST['edit_description'];
                $datetime_star2 = $_POST['edit_datetime_star'];
                $datetime_end2 = $_POST['edit_datetime_end'];
                $priority2 = $_REQUEST['edit_priority'];
                $isactive2 = $_POST['edit_isactive'];
                $setappointment->editappointment($terminname2, $description2, $datetime_star2,$datetime_end2, $isactive2, $id, $priority2);
            }
        }
    }

    public function user_deleteappointment() {
        

        $setappointment = new setappointment();
        $setappointment->deleteappointment($_GET['id']);
    }
}
