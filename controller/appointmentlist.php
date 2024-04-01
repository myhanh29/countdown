<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/database.php';
require_once 'classes/setappointment.php';

class appointmentlist {

    public function user_appointmentlist() {

        $userid = $_SESSION["user"]["id"];
        $setappointment = new setappointment();

        $appointments = $setappointment->appointmentlist($userid);
        date_default_timezone_set('Europe/Berlin');
        $today = date("Y-m-d H:i:s");

        foreach ($appointments as $row) {
            $appointmentdate = date("Y-m-d H:i:s", strtotime($row['date']));

            if ($appointmentdate < $today) {

                $setappointment = new setappointment();
                $setappointment->deleteappointment($row['id']);
            }
        }


        return $appointments;
    }
}
