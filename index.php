<?php 
session_start();
require_once("controllers/page_controller.php");

//Main applicatie
$controller = new PageController();
$controller-> handleRequest();
