<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'classes/database.php';
require_once 'classes/setappointment.php';
class appointment{
    
     public function user_appointment() {

        if (isset($_POST['terminname']) && isset($_POST['description'])&& isset($_POST['datetime'])&& isset($_POST['isactive'])) {
            $email=$_SESSION['user']['email'];
            $userid=$_SESSION['user']['id'];
            
            $terminname= $_REQUEST['terminname'];
            $description = $_REQUEST['description'];
            $datetime= $_REQUEST['datetime'];
            $isactive= $_POST['isactive'];
        
            $setappointment = new setappointment();
            
            $setappointment->appointment($terminname,$description,$datetime,$isactive,$userid);
            
        }
    }
}