<?php

    if(!isset($_GET["page"])){
        $page = "home";
    }
    else if($_GET["page"]!="login" && $_GET["page"]!="register" && $_GET["page"]!="home" && $_GET["page"]!="logout" && $_GET["page"]!="resetRequest"&& $_GET["page"]!="resetPassword" )
    {
        die("NOT FOUND");
      
    }
    else{
        $page = $_GET["page"];
    }
    

    if(!isset($_GET["event"])){
        $event = "default";
    }
   
    else{
        $event = $_GET["event"];
    }
    