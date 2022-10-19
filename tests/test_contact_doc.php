<?php
require_once "../views/contact_doc.php";
require_once("../constants.php");

$data = array ( 'page' => 'contact', 
                'menu' => array ("home" => "Home", "about" => "Over mij", "contact" => "Contact",
                "webshop" => "Wijnwinkel", "login" => "Login", "register" => "Registreer"),
                'salutation' =>	'man','salutationErr' => 'other',
                'name' => 'Donald Duck','nameErr' => 'other',
                'email' => 'donald@duckstad.nl','emailErr' => 'other',
                'commPref' => 'phone','commPrefErr' => 'other',
                'phone' => '555546596','phoneErr' => 'other',
                'message' => 'Hallo', 'messageErr' => 'other');

$view = new ContactDoc($data);

$view  -> show();

?>