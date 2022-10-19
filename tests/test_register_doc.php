<?php
require_once "../views/register_doc.php";
$data = array ( 'page' => 'Register', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                "name" => "Henk", 'nameErr' => 'onbekend', 
                'email' => 'henk@henk.nl', 'emailErr' => 'onbekend', 
                'password' => 'Hallo123.', 'passwordErr' => 'onbekend',
                'passwordCheck' => 'Hallo123.', 'passwordCheckErr' => 'onbekend');
$view = new RegisterDoc($data);

$view  -> show();

?>