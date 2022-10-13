<?php
require_once 'forms_doc.php';
class ContactDoc extends FormsDoc {
protected function showFormContent()
{
   echo '    <div>
   <label for="salutation">Aanhef:</label>
   <select id="salutation" name="salutation">
       <option value="">Maak een keuze</option>';
foreach(SALUTATIONS as $salutationKey => $salutationValue) {
   echo PHP_EOL . '<option value="' . $salutationKey . '" ';
   if ($this->data ["salutation"] == $salutationKey) { echo "selected"; } 
   echo '>' .$salutationValue. '</option>';  
}     
echo '</select> 
 <span class="error"> '. $this->data ["salutationErr"] .'</span>
</div> 
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
<label for="phone">Telefoonnummer:</label>
<input type="tel" id="phone" name="phone" value="'. $this->data ["phone"] .'">
<span class="error"> '. $this->data ["phoneErr"] .' </span>
</div>
<div>
<label for="commPref">Communicatievoorkeur:</label>' . PHP_EOL;
foreach(COMMPREFS as $key => $value) {
  echo '<input type="radio" id="cp_' . $key . '" name="commPref" value="' . $key . '" '; if ($this->data ["commPref"] == $key) { echo "checked"; } echo '><label for="cp_' . $key . '">'.$value.'</label>' . PHP_EOL;
}
echo '<span class="error"> '. $this->data ["commPrefErr"] .' </span>
</div>
<div>
<label for="message">Geef uw bericht:</label>
</div>
<div>
<textarea rows="10" cols="70" id="message" name="message">'. $this->data ["message"] .'</textarea>
<span class="error"> '. $this->data ["messageErr"] .' </span>
</div>
<input type="submit" value="Verzend"> '; 
}

} 