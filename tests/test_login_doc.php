<?php
require_once "../views/login_doc.php";
$data = array ( 'page' => 'Login', 
                'menu' => array("login" => "login", "email" => "email", "password" => "password")
                /* other fields */ );

$view = new LoginDoc($data);

$view  -> show();

?>