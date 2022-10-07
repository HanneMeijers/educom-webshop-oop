<?php
session_start();
var_dump($_SESSION);

function dologinUser($name, $userId) {
    $_SESSION['loggedInName'] = $name;
    $_SESSION['loggedInUserId'] = $userId;
    $_SESSION['shoppingCart'] = array (); /* we doen productid => hoeveelheid (quantity) */
}

function isUserLoggedIn() {
    return isset($_SESSION['loggedInName']);
}
function getLoggedInUsername() {
    return $_SESSION["loggedInName"];
}

function getLoggedInUserId () {
    return $_SESSION["loggedInUserId"];
}

function doLogoutUser() {
    unset($_SESSION['loggedInName']);
    unset($_SESSION['shoppingCart']);
}

function addProductToShoppingCart($productid) {
    if (array_key_exists($productid, $_SESSION['shoppingCart'])) {
        $_SESSION['shoppingCart'][$productid] +=1; /* dit is verkort voor als er al 1 van dit product in de shoppingcart zit, doe +1 */
    } else {
        $_SESSION['shoppingCart'][$productid] = 1;
    }
}
function decreaseProductFromShoppingCart ($productid) {
    if (array_key_exists($productid, $_SESSION['shoppingCart'])) {
        $_SESSION['shoppingCart'][$productid] -=1;
    }
    if ($_SESSION['shoppingCart'][$productid] < 1) { 
        removeProductFromShoppingCart($productid);
    }
}

function getShoppingCart() {
    return $_SESSION['shoppingCart'];
}
function removeProductFromShoppingCart($productid) {
    if (array_key_exists($productid, $_SESSION['shoppingCart'])) {
        unset($_SESSION['shoppingCart'][$productid]);
    }
}

function emptyShoppingCart () {
    $_SESSION['shoppingCart'] = array ();
}