<?php 
session_start();
require_once("controllers/page_controller.php");

$controller = new PageController();
$controller-> handleRequest();

//Main applicatie
/*
$page = getRequestedPage();
$data = processRequest($page);
var_dump($data);
showResponsePage($data);
*/
/*
function processRequest($page) {
    switch($page) {
    case 'login':
        require_once 'login.php';
        $data=validateLogin();
        if ($data ["valid"]) {
            doLoginUser($data['name'], $data['userId']);
            $page='home';
        }
        break;
    
    case 'logout':
        doLogoutUser();
        $page='home';
        break;
    
    case 'contact':
        require_once 'contact.php';
        $data = validateContact();
        if ($data['valid']) {
            $page='thanks';
        }
        break;
    
    case 'register':
        require_once 'register.php';
        $data = validateRegister();
        if ($data['valid']) {
            storeUser($data);
            $page='login';
        }
        break;

    case 'webshop':
        require_once 'webshop.php';
        $data = getWebshopData();
        break;

    case 'cart':
        require_once 'shoppingcart.php';
        $data = handleShoppingCartActions ();
        if (isset($data['ordered'])) {
            $page = 'orderconformation';
        } else {
            $data = getShoppingCartData();
        }
        break;  
    
    case 'detail';
        require_once 'webshop_details_page.php';
        $data = getWebshopDetailData();
        break;
    }

    $data['page']= $page;
    $data['menu'] = array("home" => "Home", "about" => "About", "contact" => "Contact", "webshop" => "Wijnwinkel");
    if (isUserLoggedIn()) {
        $data['menu']['cart'] = "Winkelwagen";
        $data['menu']['logout'] = "Loguit " . getLoggedInUsername();
    } else {
        $data['menu']['login'] = "Login";
        $data['menu']['register'] = "Registreer";
    }
    $data['canOrder'] = isUserLoggedIn();
    return $data;
}
 */
function showResponsePage($data) {
    $view = NULL;
    switch($data['page']) { 
        case 'home':
           require_once('views/home_doc.php');
           $view = new HomeDoc($data);
           break;
           
        case 'about':
           require_once('views/about_doc.php');
           $view = new AboutDoc($data);
           break;
           
        case 'contact':
           require_once('views/contact_doc.php');
           $view = new ContactDoc($data);
           break; 
           
        case 'register':
            require_once('views/register_doc.php');
            $view = new RegisterDoc($data);
            break;
 
        case 'webshop';
            require_once('views/webshop_doc.php');
            $view = new WebshopDoc($data);
            break;
            
        case 'detail';
            require_once('views/webshop_details_page_doc.php');
            $view = new WebshopDetailsPageDoc($data);
                break;
        
        case 'cart':
            require_once('views/shoppingcart_doc.php');
            $view = new ShoppingcartDoc($data);
                break;
      
        case 'login':
            require_once('views/login_doc.php');
            $view = new LoginDoc($data);
            break;
            
        case 'thanks':
            require_once('views/thanks_doc.php');
            $view = new ThanksDoc($data);
            break;
 
        case 'orderconformation':
             require_once('views/order_conformation_doc.php');
             $view = new OrderconformationDoc($data);
             break;
            
        default: 
           break;
    }     
    if ($view != NULL) {
        $view -> show();
    }
}

  function show404Header ()
  {
    echo 'Page not found';
  }
/*  
function showContent($data) {  
   switch($data['page']) { 
       case 'home':
          require_once('home.php');
          showHomeContent();
          break;
          
       case 'about':
          require_once('about.php');
          showAboutContent();
          break;
          
       case 'contact':
       require_once('contact.php');
          showContactForm($data);
          break; 
          
       case 'register':
           require_once('register.php');
           showRegisterForm ($data);
           break;

       case 'webshop';
       require_once('webshop.php');
           showWebshopContent($data);
           break;
           
       case 'detail';
       require_once('webshop_details_page.php');
           showWebshopDetailsContent($data);
               break;
       
       case 'cart':
       require_once('shoppingcart.php');
       showShoppingCartContent($data);
           break;
     
       case 'login':
           require_once('login.php');
           showLoginForm ($data);
           break;
           
       case 'thanks':
            showContactThanks ($data);
            break;

       case 'orderconformation':
            require_once('order_conformation.php');
            showOrderConformation ($data);
            break;
           
       default: 
          show404Content ();
          break;
   }     
} 
*/


function show404Content()
{
     echo 'Deze pagina is niet gevonden, klik op Home';
}

/**
 * Takes the input of a user and trims the whithespace in front en behind
 * and removes all html special characters or replaces them with HTML equvalents
 *
 * @param string $data the user input
 * @returns string the cleaned string.
 */
function cleanupInputFromUser($data) {;
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function logToServer ($message) {
    echo 'Logging to server' . $message;
}
   

