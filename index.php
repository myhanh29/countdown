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
    // Check if the announcement message is set
    if (isset($_SESSION['announcement'])) {
        // Display the announcement message
        echo '<div style="background-color: #FFFFCC; padding: 10px; text-align: center;">' . $_SESSION['announcement'] . '</div>';
        
        // Unset the announcement message to prevent it from being displayed again
        unset($_SESSION['announcement']);
    }
    
require_once 'router.php';
require_once("config.php");

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