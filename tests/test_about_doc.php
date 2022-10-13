<?php
require_once "../views/about_doc.php";
$data = array ( 'page' => 'About', 
                'menu' => array("about" => "about"),
                /* other fields */ );

$view = new AboutDoc($data);

$view  -> show();

?>