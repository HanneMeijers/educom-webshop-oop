<?php
require_once "repository_db.php";
require_once "webshop.php";

function getWebshopDetailData () {
    $product = NULL;
    $genericErr = '';
    $productId = getUrlVariabele('id');
    try {
        $product = getProductById ($productId); 
    }
    catch (Exception $exception) {
        $genericErr = "Sorry, door een technische fout is de web shop niet bereikbaar";
        logToServer("get webshop data failed " . $exception->getMessage());
    }
    return array('product' => $product, 'genericErr' => $genericErr);
}


function showWebshopDetailsPageHeader($data) {
    if (isset($data['product']['name'])) {
        $product = $data['product'];
        echo $product['name'];
    } else {
        echo 'Detail pagina';
    }
}

function showWebshopDetailsContent ($data) {
    $product = $data['product'];
    showDetailsWebshopProduct($product);
}

function showDetailsWebshopProduct($product) {
    echo '<div class="webshop-item">';
    echo '<div class="center"><img src="Images/' . $product['img_url'] .'" alt="' . $product['name'] . '" height="400px" ></div>' ;
    echo '<div class="center">Naam: ' . $product['name'] . '</div>';
    echo '<div class="center">Beschrijving: ' . $product['description'] . '</div>';
    echo '<div class="center">Prijs: &euro; ' . number_format ($product['price_per_one'], 2,',','.') . '</div>';
    showActionForm("addtocart", "Toevoegen", $product [ 'id' ]);
    echo '</div>';
}
?>