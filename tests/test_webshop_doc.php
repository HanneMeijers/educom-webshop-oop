<?php
require_once "../views/webshop_doc.php";

$data = array ( 'page' => 'webshop', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'products' => array(    
                    99 => array('id' => 99, 'img_url' => 'cerretalto.png', 'name'=> 'lekkere wijn', 'price_per_one' => 16.58),
                    13 => array('id' => 12, 'img_url' => 'Beaucastel.png', 'name'=> 'ook lekkere wijn', 'price_per_one' => 062.53),
                ),
                'canOrder' => true);

$view = new WebshopDoc($data);

$view  -> show();

?>