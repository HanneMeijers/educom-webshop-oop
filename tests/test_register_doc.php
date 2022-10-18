<?php
require_once "../views/register_doc.php";
$data = array ( 'page' => 'Register', 
                'menu' => array("register" => "register", "name" => "name", "email" => "email",
                "password" => "password", "passwordcheck" => "passwordcheck"));
                /* other fields */

$view = new RegisterDoc($data);

$view  -> show();

?>