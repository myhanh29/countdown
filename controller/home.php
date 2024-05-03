<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/database.php';
require_once 'classes/countdowntimer.php';
class home extends controller{
    //Methode, um Timer in Home-Seite zu zeigen
  public function user_countdown()
  {
      if (isset($_SESSION["user"]) && isset($_SESSION["user"]["id"])) {
      $userid=$_SESSION["user"]["id"];
      
      $countdowntimer = new countdowntimer();
      
      $appointments =$countdowntimer->countdown($userid);
      
      return $appointments;
      }
     
  }
}
