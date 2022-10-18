<?php
require_once "../views/product_doc.php";
$data = array ( 'page' => 'product', 
                'menu' => array("product" => "product"),
                /* other fields */ );

$view = new ProductDoc($data);

$view  -> show();

?>