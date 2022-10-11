<?php
require_once "../views/basic_doc.php";
$data = array ( 'page' => 'basic', 
                'menu' => array("eerste" => "Eerste", "tweede" => "Tweede"),
                /* other fields */ );

$view = new BasicDoc($data);

$view  -> show();

?>