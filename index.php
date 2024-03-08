<?php
session_start();
require_once 'router.php';
require_once("config.php");
require_once("classes/database.php");
$files = glob("controller" . '/*.php');
foreach ($files as $file) {
    require($file);   
}
$pageClass = new $page();
$pageClass->$event();
require_once("tpl/layout.php");
