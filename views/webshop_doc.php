<?php
require_once 'product_doc.php';
class WebshopDoc extends ProductDoc {
    protected function showHeader () {
        echo 'Wijnwinkel';
    }
    
    protected function showContent() {
        $products = $this ->model -> products;
        echo '<div class="webshop-container">';
        foreach ($products as $product) {
           $this -> showProduct($product);
        } 
        echo '</div>';
    }
    
    private function showProduct($product) {
        echo '<div class="innergrid">';
        echo '<a href="index.php?page=detail&id=' . $product['id'] .'">';
        echo '<div class="webshopimg"><img src="Images/' . $product['img_url'] .'" alt="' . $product['name'] . '" height="200px" ></div><br>' ;
        echo '<div class="webshopname">' . $product['name'] . '</div><br>';
        echo '<div class="webshopprice">&euro; ' . number_format ($product['price_per_one'], 2,',','.') . '</div>';
        echo '</a>';
        echo '<div class="webshopbutton">';
        $this -> showActionForm("addtocart", "Toevoegen", $product [ 'id' ]);
        echo '</div>';
        echo '</div>';
    }
}