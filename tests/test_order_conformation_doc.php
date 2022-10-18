<?php
require_once "../views/order_conformation_doc.php";
$data = array ( 'page' => 'orderconformation', 
                'menu' => array("orderconformation" => "orderconformation", 
                "invoicenumber" => "invoice_number", "email" => "email"));
                
$view = new OrderConformationDoc($data);

$view  -> show();

?>