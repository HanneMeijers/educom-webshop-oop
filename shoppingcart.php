<?php
require_once ("repository_db.php");
function handleShoppingCartActions () {
    $action = getPostDataVariabele("action");
    $data = array();
    switch ($action) {
        case "addtocart":
        case "increaseQuantity":
            $productid = getPostDataVariabele("productid");
            addProductToShoppingCart($productid);
            break;
        case "decreaseQuantity":
            $productid = getPostDataVariabele("productid");
            decreaseProductFromShoppingCart($productid);
            break;
        case "removefromcart":
            $productid = getPostDataVariabele("productid");
            removeProductFromShoppingCart($productid);
            break;
        case "order":
            $userid = getLoggedInUserId ();
            $data = getShoppingCartData();
            $data = storeOrder ($userid, $data["shoppingCartRows"]);
            emptyShoppingCart();
            $data['ordered'] = true;
            break;
    }
    return $data;
}

function getShoppingCartData() {
    $shoppingCartRows = array ();
    $genericErr = '';
    $total = 0;
    try {
        $products = getAllProducts (); 
        foreach ( getShoppingCart () as $productid => $quantity) {
            if (!array_key_exists($productid, $products)) {
              continue;  
            }
            $product = $products[$productid];
            $shoppingCartRow = array ('productid' => $productid, 'quantity' => $quantity, 'name' => $product['name'],
                                      'price_per_one' => $product['price_per_one'], 'img_url' => $product['img_url']);
            $subtotal = $quantity * $product['price_per_one'];
            $shoppingCartRow['subtotal'] = $subtotal;
            $total += $subtotal;
            $shoppingCartRow['running_total'] = $total;
            array_push ($shoppingCartRows, $shoppingCartRow);
        }
    }
    catch (Exception $exception) {
        $genericErr = "Sorry, door een technische fout is de web shop niet bereikbaar";
        logToServer("get webshop data failed " . $exception->getMessage());
    }
    return array('shoppingCartRows' => $shoppingCartRows, 'genericErr' => $genericErr, 'total' => $total);

}

function showShoppingCartHeader () {
    echo 'Winkelwagen';
}

function showShoppingCartContent($data) {
    $shoppingCartRows = $data['shoppingCartRows'];
    echo '<div class="winkelwagengrid">';
    echo '<div class="table-responsive">
        <table class="table-bordered">
        <tr class="table-headers">
            <th>Product</th>
            <th>Aantal</th>
            <th>Prijs</th>
            <th>Subtotaal</th>
            <th>Totaal</th>
        </tr>';
    foreach ($shoppingCartRows as $shoppingCartRow) {
        showShoppingCartRow ($shoppingCartRow);
    }
      
    echo '  
    </table>
    </div>
    </div>'; 
    showActionForm("order", "Bestellen");
    echo '</div>';
}

function showShoppingCartRow($shoppingCartRow) { 
    echo '<tr>';
    echo '<td><div><img src="Images/' . $shoppingCartRow['img_url'] .'" alt="' . $shoppingCartRow['name'] . '" height="100px" ></div>';
    echo '<span><div>'.  $shoppingCartRow['name']. '</span></td></div>';
    echo '<td>'; 
    showActionForm("decreaseQuantity", "-", $shoppingCartRow['productid']);
    echo $shoppingCartRow['quantity']; 
    showActionForm("increaseQuantity", "+", $shoppingCartRow['productid']);
    echo '</td>';
    echo '<td> &euro;&nbsp;'. number_format ($shoppingCartRow['price_per_one'], 2,',','.'). '</td>';
    echo '<td> &euro;&nbsp;'. number_format ($shoppingCartRow['subtotal'], 2,',','.'). '</td>';
    echo '<td> &euro;&nbsp;'. number_format ($shoppingCartRow['running_total'], 2,',','.'). '</td>';
    echo '<td>';
    showActionForm("removefromcard", "Verwijderen", $shoppingCartRow [ 'productid' ]);
    echo '</td>';
    echo '</tr>';
}











