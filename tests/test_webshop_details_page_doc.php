<?php
require_once "../views/webshop_details_page_doc.php";

$data = array ( 'page' => 'detail', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'product' => array('id' => 99, 'img_url' => 'cerretalto.png', 'name'=> 'lekkere wijn', 'price_per_one' => 16.58, 'description' => 'afdronk lang, medium kleur, zacht van aanzet'),                
                'canOrder' => true);

$view = new WebshopDetailsPageDoc($data);

$view  -> show();

?>