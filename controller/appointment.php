<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'classes/database.php';
require_once 'classes/setappointment.php';
class appointment{
    
     public function user_appointment() {

        if (isset($_POST['firstname']) && isset($_POST['description'])&& isset($_POST['datetime'])&& isset($_POST['isactive'])) {

            $firstname= $_REQUEST['firstname'];
            $description = $_REQUEST['description'];
            $datetime= $_REQUEST['datetime'];
            $isactive= $_REQUEST['isactive'];
            $appointment = new setappointment();
            $appointment->userid($firstname);
            $appointment->appointment($firstname,$description,$datetime,$isactive,$userid);
            
        }
    }
}