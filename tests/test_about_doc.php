<?php
require_once "../views/about_doc.php";
$data = array ( 'page' => 'About', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"));

$view = new AboutDoc($data);

$view  -> show();

?>