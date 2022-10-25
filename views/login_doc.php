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
  <input type="email" id="e-mail" name="email" value="'. $this -> model-> email .'">
  <span class="error"> '. $this -> model-> emailErr .' </span>
  </div>
  <div>
  <label for="password">Wachtwoord:</label>
  <input type="password" id="password" name="password" value="'. $this -> model -> password .'">
  <span class="error"> '. $this ->model ->passwordErr .' </span>
  </div>
  <div>
<input type="submit" value="Verzend"> 
  </div> ';
}
}



