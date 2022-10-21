<?php
class sessionManager {
        
    public function dologinUser($name, $userId) {
        $_SESSION['loggedInName'] = $name;
        $_SESSION['loggedInUserId'] = $userId;
        $_SESSION['shoppingCart'] = array (); /* we doen productid => hoeveelheid (quantity) */
    }

    public function isUserLoggedIn() {
        return isset($_SESSION['loggedInName']);
    }
    public function getLoggedInUsername() {
        return $_SESSION["loggedInName"];
    }

    public function getLoggedInUserId () {
        return $_SESSION["loggedInUserId"];
    }

    public function doLogoutUser() {
        unset($_SESSION['loggedInName']);
        unset($_SESSION['shoppingCart']);
    }

    public function addProductToShoppingCart($productid) {
        if (array_key_exists($productid, $_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'][$productid] +=1; /* dit is verkort voor als er al 1 van dit product in de shoppingcart zit, doe +1 */
        } else {
            $_SESSION['shoppingCart'][$productid] = 1;
        }
    }
    public function decreaseProductFromShoppingCart ($productid) {
        if (array_key_exists($productid, $_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'][$productid] -=1;
        }
        if ($_SESSION['shoppingCart'][$productid] < 1) { 
            $this->removeProductFromShoppingCart($productid);
        }
    }

    public function getShoppingCart() {
        return $_SESSION['shoppingCart'];
    }
    public function removeProductFromShoppingCart($productid) {
        if (array_key_exists($productid, $_SESSION['shoppingCart'])) {
            unset($_SESSION['shoppingCart'][$productid]);
        }
    }

    public function emptyShoppingCart () {
        $_SESSION['shoppingCart'] = array ();
    }
}