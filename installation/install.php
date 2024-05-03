<!DOCTYPE html>
<html lang="en">
    <head> 
        <link rel="stylesheet" href="../css/style.css">
        <title>INSTALL</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        //Erfordert alle Dateien im Controller, Klassen und Template-Dateien
        require_once 'installrouter.php';
        $files = glob("installcontroller" . '/*.php');
        foreach ($files as $file) {
            require($file);
        }
$pageClass = new $page();
$pageClass->$event();        
require_once("template/installlayout.php");
        ?>
    </body>
</html>