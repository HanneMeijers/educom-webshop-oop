<?php
require_once "../views/home_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"));

$view = new HomeDoc($data);

$view  -> show();

?>