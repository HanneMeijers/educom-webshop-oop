<?php
require_once 'forms_doc.php'; 
class RegisterDoc extends FormsDoc {

protected function showHeader () {
    echo 'Registratie';
    
}

protected function showFormContent () { 
    echo '  
   <div>
      <label for="name">Naam:</label>
      <input type="text" id="name" name="name" value="'. $this->data ["name"] .'" placeholder="Jan Klaassen">
      <span class="error"> '. $this->data ["nameErr"] .' </span>
  </div>
  <div>
      <label for="e-mail">E-mailadres:</label>
      <input type="email" id="e-mail" name="email" value="'. $this->data ["email"] .'">
      <span class="error"> '. $this->data ["emailErr"] .' </span>
  </div>
  <div>
      <label for="password">Wachtwoord:</label>
      <input type="password" id="password" name="password" value="'. $this->data ["password"] .'">
      <span class="error"> '. $this->data ["passwordErr"] .' </span>
  </div>
  <div>
      <label for="passwordCheck">Wachtwoord herhaal:</label>
      <input type="password" id="passwordCheck" name="passwordCheck" value="'. $this -> data ["passwordCheck"] .'">
      <span class="error"> '. $this->data ["passwordCheckErr"] .' </span>
  </div>
  <div>
    <input type="submit" value="Verzend"> 
 </div>
';
}
}


