<?php
require_once "../views/contact_doc.php";
$data = array ( 'page' => 'contact', 
                'menu' => array("contact" => "contact"),
                /* other fields */ );

$view = new ContactDoc($data);

$view  -> show();

?>