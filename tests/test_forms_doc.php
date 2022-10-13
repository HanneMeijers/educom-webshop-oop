<?php
require_once "../views/forms_doc.php";
$data = array ( 'page' => 'Forms', 
                'menu' => array("forms" => "forms"),
                /* other fields */ );

$view = new FormsDoc($data);

$view  -> show();

?>