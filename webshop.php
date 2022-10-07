<?php
require_once "repository_db.php";
function getWebshopData () {
    $products = array();
    $genericErr = '';
    try {
    $products = getAllProducts (); 
    }
    catch (Exception $exception) {
        $genericErr = "Sorry, door een technische fout is de webshop niet bereikbaar";
        logToServer("get webshop data failed " . $exception->getMessage());
    }
    return array('products' => $products, 'genericErr' => $genericErr);
}

function showWebshopHeader () {
    echo 'Wijnwinkel';
}

function showWebshopContent($data) {
    $products = $data['products'];
    echo '<div class="webshop-container">';
    foreach ($products as $product) {
        showWebshopProduct($product);
    } 
    echo '</div>';
}

function showWebshopProduct($product) {
    echo '<div class="innergrid">';
    echo '<a href="index.php?page=detail&id=' . $product['id'] .'">';
    echo '<div class="webshopimg"><img src="Images/' . $product['img_url'] .'" alt="' . $product['name'] . '" height="200px" ></div><br>' ;
    echo '<div class="webshopname">' . $product['name'] . '</div><br>';
    echo '<div class="webshopprice">&euro; ' . number_format ($product['price_per_one'], 2,',','.') . '</div>';
    echo '</a>';
    echo '<div class="webshopbutton">';
    showActionForm("addtocart", "Toevoegen", $product [ 'id' ]);
    echo '</div>';
    echo '</div>';
}






