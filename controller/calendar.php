<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/setcalendar.php';
require_once 'classes/setappointment.php';
class calendar{
    public function user_calendar(){
        $userid=$_SESSION['user']['id'];
        $setappointment = new setappointment();
        $appointments=$setappointment->appointmentlist($userid);
        $setcalendar = new setcalendar();
        foreach($appointments as $row)
        {
           $setcalendar->add_event($row['name'], date("Y-m-d H:i:s", strtotime($row['date_star'])),date("Y-m-d H:i:s", strtotime($row['date_end'])), $days = 1, $color = '');
        }
       
 
       echo $setcalendar->__toString();
       echo $setcalendar->_createdaycalendar() ;
    }
    
}