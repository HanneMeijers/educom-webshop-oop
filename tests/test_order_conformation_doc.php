<?php
require_once "../views/order_conformation_doc.php";
$data = array ( 'page' => 'orderconformation', 
                    'menu' => array("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                         "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                        'email' => 'henk@henk.nl', 'emailErr' => 'onbekend',
                        "invoice_number" => "invoice_number");      
                
$view = new OrderConformationDoc($data);

$view  -> show();

?>