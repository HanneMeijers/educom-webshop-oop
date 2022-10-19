<?php
require_once "product_doc.php";
class WebshopDetailsPageDoc extends ProductDoc {

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
            echo '<div class="center"><img src="Images/' . $this->product ['img_url'] .'" alt="' . $this->product ['name'] . '" height="400px" ></div>' ;
            echo '<div class="center">Naam: ' . $this->product['name'] . '</div>';
            echo '<div class="center">Beschrijving: ' . $this->product['description'] . '</div>';
            echo '<div class="center">Prijs: &euro; ' . number_format ($this->product['price_per_one'], 2,',','.') . '</div>';
            showActionForm("addtocart", "Toevoegen", $this->product [ 'id' ]);
            echo '</div>';
        }
}