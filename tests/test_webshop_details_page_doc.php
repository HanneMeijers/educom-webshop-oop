<?php
require_once "../views/webshop_details_page_doc.php";

$data = array ( 'page' => 'detail', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'canOrder' => true);

$view = new WebshopDetailsPageDoc($data);

$view  -> show();

?>