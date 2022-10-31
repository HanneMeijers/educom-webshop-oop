<?php
require_once 'product_doc.php'; 
class OrderConformationDoc extends ProductDoc {

protected function showHeader () {
    echo 'Bestelbevestiging';
    
}

protected function showContent () { 
echo '<p>Bedankt voor uw bestelling. <br>
 Uw bestelnummer is: '. $this->model -> invoiceNumber .' <br>
 De bevestiging wordt gemaild naar: '. $this->model-> email .'</p>';
}
}