<?php
//Wenn keine Seite gegeben wird, wird "home" automatisch gewählt
    if(!isset($_GET["page"])){
        $page = "startseite";
    }
//Wenn eine fremde Seite gegeben wird, wird NICHT GEFUNDEN gezeigt
    else if($_GET["page"]!="fillconfig"&&$_GET["page"]!="setadmin"&&$_GET["page"]!="startseite" )
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
    