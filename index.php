<?php 
require_once("session_manager.php");
//Main applicatie
$page = getRequestedPage();
$data = processRequest($page);
var_dump($data);
showResponsePage($data);

function getRequestedPage () {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $requestedPage = getUrlVariabele('page', 'home');
    } else {
        $requestedPage = getPostDataVariabele('page');
    }
    return ($requestedPage);
    
}
/**
 * Zoek variabele in de url en retourneer deze.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return value of the $key or the $default if $key is not found. 
 */
function getUrlVariabele($key, $default = '') {
 return getArrayVar($_GET, $key, $default);
}
/**
 * Zoek variabele in de POST data en retourneer deze.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return value of the $key or the $default if $key is not found. 
 */
function getPostDataVariabele($key, $default = '') {
return getArrayVar($_POST, $key, $default);
}
/**
 * Zoek variabele in de $array en retourneer deze.
 * @param $array dit is de array waarin we gaan zoeken.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return value of the $key or the $default if $key is not found. 
 */
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
} 

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
    return $data;
}

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
            require_once('register.php');
            break;
 
        case 'webshop';
            require_once('webshop.php');
            break;
            
        case 'detail';
            require_once('webshop_details_page.php');
                break;
        
        case 'cart':
            require_once('shoppingcart.php');
            
            break;
      
        case 'login':
            require_once('login.php');
            break;
            
        case 'thanks':
            require_once('views/thanks_doc.php');
            $view = new ThanksDoc($data);
            break;
 
        case 'orderconformation':
             require_once('order_conformation.php');
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

function showActionForm ($action, $buttontext, $productid= null) {
   if (isUserLoggedIn()) {
    echo '    <form method="post" action="index.php" >   
   <input type="hidden" name="page" value="cart"> 
   <input type="hidden" name="productid" value="'. $productid . '">
   <input type="hidden" name="action" value="'. $action .'"> 
   <button>' . $buttontext. '</button>
   </form> ';
    }
    }
   

