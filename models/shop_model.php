<?php
require_once "models/page_model.php";
require_once "repository_db.php";
class ShopModel extends PageModel {
    public $products = array();
    public $product = NULL;
    public $canOrder = false;
    public $shoppingCartRows = array ();
    public $total = 0;
    public $ordered = false;
    public $email = '';
    public $invoiceNumber = '';
    
    
    public function __construct($pageModel) {

        PARENT::__construct($pageModel);
        if ($this-> sessionManager-> isUserLoggedIn()) {
            $this -> canOrder = true;
        }
    }
    public function getWebshopData () {
        try {
        $this->products = getAllProducts (); 
        }
        catch (Exception $exception) {
        $this-> genericErr = "Sorry, door een technische fout is de webshop niet bereikbaar";
            $this->logToServer("get webshop data failed " . $exception->getMessage());
        }
    }
   
    function getWebshopDetailData () {
        $productId = $this-> getUrlVariabele('id');
        try {
            $this->product = getProductById ($productId); 
        }
        catch (Exception $exception) {
            $this->genericErr = "Sorry, door een technische fout is de web shop niet bereikbaar";
            $this->logToServer("get webshop data failed " . $exception->getMessage());
        }
    }
    
    public function getShoppingCartData() {
        try {
            $products = getAllProducts (); 
            foreach ( $this->sessionManager ->getShoppingCart () as $productid => $quantity) {
                if (!array_key_exists($productid, $products)) {
                  continue;  
                }
                $product = $products[$productid];
                $shoppingCartRow = array ('productid' => $productid, 'quantity' => $quantity, 'name' => $product['name'],
                                          'price_per_one' => $product['price_per_one'], 'img_url' => $product['img_url']);
                $subtotal = $quantity * $product['price_per_one'];
                $shoppingCartRow['subtotal'] = $subtotal;
                $this->total += $subtotal;
                $shoppingCartRow['running_total'] = $this->total;
                array_push ($this->shoppingCartRows, $shoppingCartRow);
            }
        }
        catch (Exception $exception) {
            $this->genericErr = "Sorry, door een technische fout is de web shop niet bereikbaar";
            $this->logToServer("get webshop data failed " . $exception->getMessage());
        }
    }

    public function handleShoppingCartActions () {
        
        $action = $this-> getPostDataVariabele("action");
        switch ($action) {
            case "addtocart":
            case "increaseQuantity":
                $productid = $this->getPostDataVariabele("productid");
                $this->sessionManager->addProductToShoppingCart($productid);
                break;
            case "decreaseQuantity":
                $productid = $this->getPostDataVariabele("productid");
                $this->sessionManager->decreaseProductFromShoppingCart($productid);
                break;
            case "removefromcart":
                $productid = $this->getPostDataVariabele("productid");
                $this->sessionManager-> removeProductFromShoppingCart($productid);
                break;
            case "order":
                $userid = $this->sessionManager->getLoggedInUserId ();
                $this->getShoppingCartData();
                $invoiceArray = storeOrder ($userid, $this->shoppingCartRows);
                $this->sessionManager->emptyShoppingCart();
                $this->ordered = true;
                $this->invoiceNumber = $invoiceArray ["invoice_number"];
                $this->email = $invoiceArray ["email"];
                break;
        }
    }
}
