<?php
require_once 'forms_doc.php'; 
class LoginDoc extends FormsDoc {

protected function showHeader () {
    echo 'Log in';
    
}

protected function showFormContent () {
    echo '
  <div>
  <label for="e-mail">E-mailadres:</label>
  <input type="email" id="e-mail" name="email" value="'. $this -> data ["email"] .'">
  <span class="error"> '. $this -> data ["emailErr"] .' </span>
  </div>
  <div>
  <label for="password">Wachtwoord:</label>
  <input type="password" id="password" name="password" value="'. $this -> data ["password"] .'">
  <span class="error"> '. $this -> data ["passwordErr"] .' </span>
  </div>
  <div>
<input type="submit" value="Verzend"> 
  </div> ';
}
}



