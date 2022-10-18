<?php
require_once "webshop_doc.php";
class WebshopDetailsPageDoc extends WebshopDoc {

        protected function showHeader() {
            if (isset($this -> data['product']['name'])) {
                $product = $this -> data['product'];
                echo $product['name'];
            } else {
                echo 'Detail pagina';
            }
        }

        protected function showContent () {
            $product = $this -> data['product'];
            $this ->  showProduct($product);
        }

        private function showProduct($product) {
            echo '<div class="webshop-item">';
            echo '<div class="center"><img src="Images/' . $product['img_url'] .'" alt="' . $product['name'] . '" height="400px" ></div>' ;
            echo '<div class="center">Naam: ' . $product['name'] . '</div>';
            echo '<div class="center">Beschrijving: ' . $product['description'] . '</div>';
            echo '<div class="center">Prijs: &euro; ' . number_format ($product['price_per_one'], 2,',','.') . '</div>';
            showActionForm("addtocart", "Toevoegen", $product [ 'id' ]);
            echo '</div>';
        }
}