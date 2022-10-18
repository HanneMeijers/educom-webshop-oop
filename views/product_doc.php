<?php
require_once "basic_doc.php";

abstract class ProductDoc extends BasicDoc {
    protected function showActionForm ($action, $buttontext, $productid= null) {
        if (isUserLoggedIn()) {
         echo '    <form method="post" action="index.php" >   
        <input type="hidden" name="page" value="cart"> 
        <input type="hidden" name="productid" value="'. $productid . '">
        <input type="hidden" name="action" value="'. $action .'"> 
        <button>' . $buttontext. '</button>
        </form> ';
         }
    }
}

