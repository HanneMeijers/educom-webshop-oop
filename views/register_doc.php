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
      <input type="text" id="name" name="name" value="'. $this->model-> name .'" placeholder="Jan Klaassen">
      <span class="error"> '. $this->model-> nameErr .' </span>
  </div>
  <div>
      <label for="e-mail">E-mailadres:</label>
      <input type="email" id="e-mail" name="email" value="'. $this->model-> email .'">
      <span class="error"> '. $this->model-> emailErr .' </span>
  </div>
  <div>
      <label for="password">Wachtwoord:</label>
      <input type="password" id="password" name="password" value="'. $this->model->password .'">
      <span class="error"> '. $this->model-> passwordErr .' </span>
  </div>
  <div>
      <label for="passwordCheck">Wachtwoord herhaal:</label>
      <input type="password" id="passwordCheck" name="passwordCheck" value="'. $this -> model ->passwordCheck .'">
      <span class="error"> '. $this->model-> passwordCheckErr .' </span>
  </div>
  <div>
    <input type="submit" value="Verzend"> 
 </div>
';
}
}


