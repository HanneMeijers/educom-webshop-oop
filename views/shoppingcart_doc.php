<?php
require_once 'product_doc.php';
class ShoppingcartDoc extends ProductDoc {


    protected function showHeader () {
        echo 'Winkelwagen';
    }

protected function showContent() {
    $shoppingCartRows = $this -> data['shoppingCartRows'];
    echo '<div class="winkelwagengrid">';
    echo '
        <table class="table-bordered">
        <tr class="table-headers">
            <th>Product</th>
            <th>Aantal</th>
            <th>Prijs</th>
            <th>Subtotaal</th>
            <th>Totaal</th>
        </tr>';
    foreach ($shoppingCartRows as $shoppingCartRow) {
        $this -> showShoppingCartRow ($shoppingCartRow);
    }
      
    echo '  
    </table>
    
    </div>'; 
    $this->showActionForm("order", "Bestellen");
}

private function showShoppingCartRow($shoppingCartRow) { 
    echo '<tr>';
    echo '<td><div><img src="Images/' . $shoppingCartRow['img_url'] .'" alt="' . $shoppingCartRow['name'] . '" height="100px" ></div>';
    echo '<span><div>'.  $shoppingCartRow['name']. '</div></span></td>';
    echo '<td>'; 
    $this->showActionForm("decreaseQuantity", "-", $shoppingCartRow['productid']);
    echo $shoppingCartRow['quantity']; 
    $this->showActionForm("increaseQuantity", "+", $shoppingCartRow['productid']);
    echo '</td>';
    echo '<td> &euro;&nbsp;'. number_format ($shoppingCartRow['price_per_one'], 2,',','.'). '</td>';
    echo '<td> &euro;&nbsp;'. number_format ($shoppingCartRow['subtotal'], 2,',','.'). '</td>';
    echo '<td> &euro;&nbsp;'. number_format ($shoppingCartRow['running_total'], 2,',','.'). '</td>';
    echo '<td>';
    $this->showActionForm("removefromcard", "Verwijderen", $shoppingCartRow [ 'productid' ]);
    echo '</td>';
    echo '</tr>';
}
}