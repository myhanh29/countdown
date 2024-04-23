<?php
//Wenn keine Seite gegeben wird, wird "home" automatisch gewählt
    if(!isset($_GET["page"])){
        $page = "home";
    }
//Wenn eine fremde Seite gegeben wird, wird NICHT GEFUNDEN gezeigt
    else if($_GET["page"]!="login" && $_GET["page"]!="register" && $_GET["page"]!="home" && $_GET["page"]!="logout" && $_GET["page"]!="resetRequest"&& $_GET["page"]!="resetPassword"&& $_GET["page"]!="appointment"&& $_GET["page"]!="appointmentlist"&& $_GET["page"]!="calendar"&& $_GET["page"]!="userlist"&& $_GET["page"]!="edituser" )
    {
        die("NICHT GEFUNDEN");
      
    }
    else{
        $page = $_GET["page"];
    }
    
//Wenn kein EVENT gegeben wird, ist event default
    if(!isset($_GET["event"])){
        $event = "default";
    }
   
    else{
        $event = $_GET["event"];
    }
    