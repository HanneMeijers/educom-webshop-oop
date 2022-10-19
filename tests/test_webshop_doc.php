<?php
require_once "../views/webshop_doc.php";

$data = array ( 'page' => 'webshop', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'canOrder' => true);

$view = new WebshopDoc($data);

$view  -> show();

?>