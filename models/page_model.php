<?php
require_once "session_manager.php";
require_once "menu_item.php";

class PageModel {
 
   public $page;
   protected $isPost = false;
   public $menu;
   public $genericErr = '';
   protected $sessionManager;

   public function __construct($copy) {
      if (empty($copy)) {
          // ==> First instance of PageModel
          $this->sessionManager = new SessionManager();
       } else {
          // ==> Called from the constructor of an extended class.... 
          $this->page = $copy->page;
          $this->isPost = $copy->isPost;
          $this->menu = $copy->menu;
          $this->genericErr = $copy->genericErr;
          $this->sessionManager = $copy->sessionManager; 
       }
   }

   public function getRequestedPage() {

      $this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');

      if ($this->isPost) {
          $this->setPage($this->getPostDataVariabele("page", "home"));
      } else {
          $this->setPage($this->getUrlVariabele("page", "home"));
      }
   }
  
   public function setPage($newPage) {
        $this->page = $newPage;
   } 
 /**
 * Zoek variabele in de POST data en retourneer deze.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return mixed value of the $key or the $default if $key is not found. 
 */
function getPostDataVariabele($key, $default = '') {
    return $this->getArrayVar($_POST, $key, $default);
    }
    /**
     * Zoek variabele in de $array en retourneer deze.
     * @param $array dit is de array waarin we gaan zoeken.
     * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
     * @param $default (optional) value to return when the $key is not found.
     * @return mixed value of the $key or the $default if $key is not found. 
     */
    function getArrayVar($array, $key, $default='') 
    { 
       return isset($array[$key]) ? $array[$key] : $default; 
    } 

    /**
     * Zoek variabele in de GET data en retourneer deze.
     * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
     * @param $default (optional) value to return when the $key is not found.
     * @return mixed value of the $key or the $default if $key is not found. 
     */
function getUrlVariabele($key, $default = '') {
    return $this->getArrayVar($_GET, $key, $default);
    }

    protected function logToServer ($message) {
      echo 'Logging to server' . $message;
  }

   public function createMenu() {
      $this->menu['home'] = new MenuItem('home', 'Home');
      $this->menu['about'] = new MenuItem('about', 'Over Mij');
      $this->menu['contact'] = new MenuItem('contact', 'Contact');
      $this->menu['webshop'] = new MenuItem('webshop', 'Wijnwinkel');

      if ($this->sessionManager->isUserLoggedIn()) {
         $this->menu['cart'] = new MenuItem('cart', 'Winkelwagen');                  
         $this->menu['logout'] = new MenuItem('logout', 'Logout', 
                                              $this->sessionManager->getLoggedInUsername());
      } else {
         $this->menu['login'] = new MenuItem('login', 'Login');
         $this->menu['register'] = new MenuItem('register', 'Registreer');   
      }
   }
}