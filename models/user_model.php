<?php

require_once "models/page_model.php";
require_once "constants.php";
class UserModel extends PageModel {
    public $salutation ="";
    public $name = "";
    public $email = "";
    public $phone = "";
    public $commPref = "";
    public $message = "";
    public $salutationErr = "";
    public $nameErr = "";
    public $emailErr = "";
    public $phoneErr = "";
    public $commPrefErr = "";
    public $messageErr = "";
    public $userId = 0;
    public $valid = false;
    public $password = "";
    public $passwordErr = "";
    public $passwordCheck = "";
    public $passwordCheckErr = "";
    
    public function __construct($pageModel) {

        PARENT::__construct($pageModel);

    }
    
    public function validateContact() {
        if (!$this->isPost) {
            return;
        }
        // validate the 'Post' data //
    
        $this -> salutation = $this-> getCleanPostDataVariabele("salutation");
        if (empty($this ->salutation)) { 
        $this -> salutationErr = "Aanhef is verplicht"; 
        } 

       $this -> name = $this-> getCleanPostDataVariabele("name");
        if (empty($this -> name)) {
            $this -> nameErr = "Naam is verplicht";
        }

        $this -> email = $this-> getCleanPostDataVariabele("email");
        if (empty($this -> email)) {
            $this -> emailErr = "E-mail is verplicht";
        }

        $this ->phone = $this->getCleanPostDataVariabele("phone");
        if (empty($this -> phone)) {
            $this -> phoneErr = "Telefoonnummer verplicht";
        }    

        $this -> commPref = $this->getCleanPostDataVariabele("commPref");
        if (empty($this -> commPref)) {
            $this -> commPrefErr = "Communicatievoorkeur verplicht";
        }

        $this -> message = $this->getCleanPostDataVariabele("message");
        if (empty ($this -> message)) {
            $messageErr = "Bericht is verplicht";
        } 

        if (empty($this ->salutationErr) && empty($this ->nameErr) && empty($this ->emailErr) && empty ($this ->phoneErr) 
        && empty($this ->commPrefErr) && empty($this -> messageErr)) {
            $this ->valid = true;
        }
    }
    public function validateLogin() {
        
        if (!$this->isPost) {
            return;
        }
        // It is a post
        $this->email = $this->getCleanPostDataVariabele('email');
        if (empty($this->email)) {
            $this->emailErr = "E-mail is verplicht";
        } else {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = "Vul geldig e-mailadres in";
            }
        }

        $this->password = $this->getCleanPostDataVariabele("password");
        if (empty($this->password)) {
            $this->passwordErr = "Vul wachtwoord in";
        } 
        
        if (!empty($this->emailErr) || !empty($this->passwordErr)) {
            return;
        }
            
        try {
            $userArray = $this->authenticateUser();
            if (empty($userArray)) {
                $this->genericErr = "Geen geldig e-mailadres of password onjuist";
            } else {
                $this->valid = true;
                $this->name = $userArray["name"];
                $this->userId = $userArray["id"];
            }
        }
        catch (Exception $exception) {
            $this->genericErr = "technische fout: u kan op dit moment niet inloggen";
            $this->logToServer("registration failed " . $exception->getMessage());
        }
    }
    /**
     * Takes the input of a user and trims the whithespace in front en behind
     * and removes all html special characters or replaces them with HTML equvalents
     *
     * @param string $key the POST field key
     * @return string the cleaned value.
     */
    private function getCleanPostDataVariabele($key) {
        $value = $this->getPostDataVariabele($key);
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

       public function doLoginUser() {

          $this->sessionManager->loginUser($this->name, $this->userId);

          $this->genericErr = "Login successvol";
       }

}







