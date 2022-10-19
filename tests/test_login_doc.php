<?php
require_once "../views/login_doc.php";
$data = array ( 'page' => 'Login', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                "email" => 'henk@henk.nl', 'emailErr' => "onbekend", 
                'password' => 'Hallo123.', 'passwordErr' => 'onbekend');

$view = new LoginDoc($data);

$view  -> show();

?>