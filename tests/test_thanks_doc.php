<?php
require_once "../views/thanks_doc.php";
require_once("../constants.php");

$data = array ( 'page' => 'Thanks', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'salutation' =>	'man',
                'name' => 'Donald Duck',
                'email' => 'donald@duckstad.nl',
                'commPref' => 'phone',
                'phone' => '555546596',
                'message' => 'Hallo' );

$view = new ThanksDoc($data);

$view  -> show();

?>