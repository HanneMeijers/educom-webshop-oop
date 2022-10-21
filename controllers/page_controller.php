<?php
require_once "models/page_model.php";

class PageController {

   private $model;

   public function __construct() {
      $this->model = new PageModel(NULL);
   }

   public function handleRequest() {
      $this->getRequest();
	  $this->processRequest();
      $this->showResponsePage();
  }

  // from client
  private function getRequest() {
      $this->model->getRequestedPage();
  }

  // business flow code
  private function processRequest() {
      switch($this->model->page) {

      case "Login":
/*         $this->model = new UserModel($this->model);
         $this->model->validateLogin();
         if ($this->model->valid) {
			 $this->model->doLoginUser();
             $this->model->setPage("home");
		 } */
         break;
        case "register":
  /*       $this->model = new UserModel($this->model);
         $this->model->validateRegister();
         if ($this->model->valid) {
                $this->model->storeUser();
                $this->model->setPage("home");
            } */
            break;
    }
  }
  // to client: presentatie laag
  private function showResponsePage() {
      $this->model->createMenu();

      switch($this->model->page) {
        case "home":
         require_once("views/home_doc.php");
            $view = new HomeDoc($this->model);
         break;
        case "about":
        require_once("views/about_doc.php");
            $view = new AboutDoc($this->model);
        break;
        case "contact":
            require_once("views/contact_doc.php");
            $view = new ContactDoc($this->model);
            break;
        case "webshop":
            require_once("views/webshop_doc.php");
            $view = new WebshopDoc($this->model);
            break;
        case "thanks":
                require_once("views/thanks_doc.php");
            $view = new ThanksDoc($this->model);
            break;
        case "login":
            require_once("views/login_doc.php");
            $view = new LoginDoc($this->model);
            break;
        case "register":
                require_once("views/register_doc.php");
                $view = new RegisterDoc($this->model);
            break;
        case "logout":
               require_once("views/home_doc.php");
            $view = new HomeDoc($this->model);
            break;
        case "cart":
              require_once("views/shoppingcart_doc.php");
            $view = new ShoppingCartDoc($this->model);
            break;
            /*
        case orderconformation
            require_once("orderconformation
            */
        default:
            require_once("views/unknown_page_doc.php");
            $view = new UnknownPageDoc ($this->model);
    }
    $view->show();
   }
}