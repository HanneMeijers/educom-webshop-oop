<?php
require_once "product_doc.php";
class WebshopDetailsPageDoc extends ProductDoc {

        protected function showHeader() {
            if (isset($this -> model-> product)) {
                $product = $this -> model->product;
                echo $product['name'];
            } else {
                echo 'Detail pagina';
            }
        }

        protected function showContent () {
            $product = $this -> model -> product;
            $this ->  showProduct($product);
        }

        private function showProduct($product) {
            echo '<div class="webshop-item">';
            echo '<div class="center"><img src="Images/' . $product ['img_url'] .'" alt="' . $product ['name'] . '" height="400px" ></div>' ;
            echo '<div class="center">Naam: ' . $product['name'] . '</div>';
            echo '<div class="center">Beschrijving: ' . $product['description'] . '</div>';
            echo '<div class="center">Prijs: &euro; ' . number_format ($product['price_per_one'], 2,',','.') . '</div>';
            echo '<div class="webshopDetailButton">';
            $this->showActionForm("addtocart", "Toevoegen", $product [ 'id' ]);
            echo '</div>';
            echo '</div>';
        }
}