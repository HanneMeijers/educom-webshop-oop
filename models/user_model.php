<?php

require_once "models/page_model.php";
require_once "constants.php";
require_once "repository_db.php";
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

        $this -> validateEmail();

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
        $this -> validateEmail();

        $this->password = $this->getCleanPostDataVariabele("password");
        if (empty($this->password)) {
            $this->passwordErr = "Vul wachtwoord in";
        } 
        
        if (!empty($this->emailErr) || !empty($this->passwordErr)) {
            return;
        }
            
        try {
            $this->authenticateUser();
            if (empty($this->userId)) {
                $this->genericErr = "Geen geldig e-mailadres of password onjuist";
            } else {
                $this->valid = true;                
            }
        }
        catch (Exception $exception) {
            $this->genericErr = "technische fout: u kan op dit moment niet inloggen";
            $this->logToServer("registration failed " . $exception->getMessage());
        }
    }

    function validateRegister () {
        if (!$this->isPost) {
            return;
        }
        $this->name = $this->getCleanPostDataVariabele('name');
        if (empty($this->name)) {
             $this->nameErr = "Naam is verplicht";
        } else if (!preg_match("/^[a-zA-Z-' ]*$/",$this->name)) {
            $this->nameErr = "Alleen letters en witregels toegestaan";
        }
        elseif (strlen($this->name)>50) {
            $this->nameErr = "Naam moet minder dan 50 karakters zijn";
        } 
        $this -> validateEmail ();
        
        $this->password = $this->getCleanPostDataVariabele('password');
        if (empty($this->password)) {
            $this-> passwordErr = "Vul wachtwoord in";
        } else if (strlen($this->password)>40) {
            $this->passwordErr = "Wachtwoord moet minder dan 40 karakters zijn";
        }
        $this->passwordCheck = $this->getCleanPostDataVariabele('passwordCheck');
        if (empty($this->passwordCheck)) {
           $this->passwordCheckErr = "Herhaal wachtwoord";
        } 

        if (empty($this->nameErr) && empty($this->emailErr) && empty($this->passwordErr) && empty($this->passwordCheckErr)) {
            try {
                if ($this-> doesUserExist()) {
                    $this->emailErr = "e-mailadres is al in gebruik, ga naar login";
                    } else{
                    $this->valid = true;
                    }
                } catch (Exception $exception) {
                    $this->emailErr = "technische fout: kan u op dit moment niet registreren";
                    $this->logToServer("registration failed " . $exception->getMessage());
                    }
            }
           
        }

    private function validateEmail() {
        $this->email = $this->getCleanPostDataVariabele('email');
        if (empty($this->email)) {
            $this->emailErr = "E-mail is verplicht";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = "ongeldig email format";
        }
        elseif (strlen($this->email)>50) {
            $this->emailErr = "email moet minder dan 50 karakters zijn";
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
    private function doesUserExist() {
        $userArray=findUserByEmail($this->email);
        return !empty($userArray);
    }
    private function authenticateUser() {

        require_once "repository_db.php";

        $userArray=findUserByEmail($this->email);
        if (empty($userArray)) {
            return;
        }
        if ($userArray["password"] != $this->password){
            return;
        }
        
        $this->name = $userArray["name"];
        $this->userId = $userArray["id"];

    }

    public function storeUser() {
        saveUser($this-> email, $this->name, $this->password);
    }


    public function doLoginUser() {

        $this->sessionManager->dologinUser($this->name, $this->userId);

        $this->genericErr = "Login successvol";
    }
    public function doLogoutUser() {

        $this->sessionManager->doLogoutUser();

        $this->genericErr = "Succesvol uitgelogd";
    }

}







