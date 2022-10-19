<?php
require_once "../views/shoppingcart_doc.php";

$data = array ('page' => 'cart', 
                'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'canOrder' => true,
                'shoppingCartRows' => array(
                    99 => array('productid' => 99, 'img_url' => 'cerretalto.png', 'name'=> 'lekkere wijn', 'price_per_one' => 16.58, 'quantity' => 3, 'subtotal' => 99.78, 'running_total' => 1203.63),
                    13 => array('productid' => 12, 'img_url' => 'Beaucastel.png', 'name'=> 'ook lekkere wijn', 'price_per_one' => 062.53, 'quantity' => 2, 'subtotal' => 239.78, 'running_total' => 1545.54),
                )
            );

$view = new ShoppingcartDoc($data);

$view  -> show();

?>