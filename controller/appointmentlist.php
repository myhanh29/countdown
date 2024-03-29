<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/database.php';
require_once 'classes/setappointment.php';

class appointmentlist{

public function user_appointmentlist() {

  $userid=$_SESSION["user"]["id"];
  $setappointment = new setappointment();
       
  $appointments = $setappointment->appointmentlist($userid);
        return $appointments;
 
}
}
