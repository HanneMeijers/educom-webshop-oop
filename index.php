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
    return $data;
}

function showResponsePage($data) {
   beginDocument(); 
   showHeadSection(); 
   showBodySection($data); 
   endDocument();  
}

function beginDocument() 
{ 
   echo '<!doctype html> 
<html>'; 
} 

function showHeadSection() 
{ 
  echo '<head>'; 
  echo '<link rel="stylesheet" href="CSS\mystyle.css">';
  echo '</head>';
}

function showBodySection($data) 
{ 
   echo '    <body>' . PHP_EOL; 
   showHeader($data);
   showMenu(); 
   showGenericErr($data); 
   showContent($data); 
   showFooter(); 
   echo '    </body>' . PHP_EOL; 
} 

function endDocument() 
{ 
   echo  '</html>'; 
} 

function showHeader($data) 
{ 
    echo '<h1 class="title">';
    switch ($data['page']) 
   { 
       case 'home':
          require_once('home.php');
          showHomeHeader();
          break;
       case 'cart':
          require_once('shoppingcart.php');
          showShoppingCartHeader();
          break;
       case 'webshop';
       require_once('webshop.php');
          showWebshopHeader();
          break;
       case 'about':
          require_once('about.php');
          showAboutHeader();
          break;
       case 'contact':
       case 'thanks':
          require_once('contact.php');
          showContactHeader();
          break; 
       case 'register':
          require_once('register.php');
          showRegisterHeader();
          break; 
       case 'login':
          require_once('login.php');
          showLoginHeader();
          break;
       case 'logout':
          require_once('home.php');
          break;
       case 'detail':
          require_once('webshop_details_page.php');
          showWebshopDetailsPageHeader($data);
          break;
       case 'orderconformation':
          require_once('order_conformation.php');
          showOrderconformationHeader();
          break;
       default:
          show404Header();
          break;           
   }     
    echo '</h1>';  
} 

function showMenu ()
{
   echo '<ul class="navigation">
    <li><a HREF="index.php?page=home">Home</a></li>
    <li><a HREF="index.php?page=about">Over mij</a></li>
    <li><a HREF="index.php?page=contact">Contact</a></li>
    <li><a HREF="index.php?page=webshop">Wijnwinkel</a></li>';
    

    if (isUserLoggedIn()) {
        echo ' <li><a HREF="index.php?page=cart">Winkelwagen</a></li>';
        echo '<li><a HREF="index.php?page=logout">Loguit ' . getLoggedInUsername() . '</a></li>';
    } else {
        echo '<li><a HREF="index.php?page=login">Login</a></li>;
              <li><a HREF="index.php?page=register">Registreer</a></li>';
    }
    echo '</ul>' ;
}
function showGenericErr($data) {
    if (isset($data ["genericErr"])) {
        echo '<div class="error">'. $data ["genericErr"] ."</div>";
    }
}
  function show404Header ()
  {
    echo 'Page not found';
  }
  
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

function showFooter ()
  {
      echo '<footer>';
      echo '<p><span>&copy;</span> 2022 Author: Hanne Meijers</p>';
      echo '</footer>';
  }

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
   

