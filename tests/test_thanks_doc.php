<?php
require_once "../views/thanks_doc.php";
$data = array ( 'page' => 'Thanks', 
                'menu' => array("thanks" => "thanks"),
                'salutation' =>	'mr',
                'name' => 'Donald Duck',
                'email' => 'donald@duckstad.nl',
                'commpref' => 'phone',
                'phone' => '555546596',
                'message' => 'Hallo'
                /* other fields */ );

$view = new ThanksDoc($data);

$view  -> show();

?>