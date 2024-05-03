<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<?php
session_start();
    // Prüfen, ob "announcement" Nachricht  bereits eingestellt ist
    if (isset($_SESSION['announcement'])) {
        //"announcement" Nachricht wird gezeigt
        echo '<div style="background-color: #FFFFCC; padding: 10px; max-width: 400px; margin: 0 auto; text-align: center;">' . $_SESSION['announcement'] . '</div>';
        
        // Die Ansage zurücksetzen, um zu verhindern, dass sie erneut angezeigt wird
        unset($_SESSION['announcement']);
    }
  //alle Seiten und das Layout benötigen   
require_once 'router.php';
require_once("config.php");

    // Überprüfen, ob alle Konfigurationsvariablen definiert sind
    if (!defined('DBSERVER')&&!defined('DBUSER')&&!defined('DBPASS')&&!defined('DBNAME')|| empty(DBSERVER)&& empty(DBUSER)&& empty(DBNAME)) {
        //Wenn nicht alles definiert ist, führe ich zur Installation 
        header("Location: installation/install.php");
        exit;
    }

require_once("classes/database.php");
require_once("classes/user.php");
$files = glob("controller" . '/*.php');
foreach ($files as $file) {
    require($file);   
}
$pageClass = new $page();
$pageClass->$event();
require_once("tpl/layout.php");
 ?>
</body>
</html>