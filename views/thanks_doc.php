<?php
require_once 'basic_doc.php'; 

class ThanksDoc extends BasicDoc {

protected function showHeader () {
    echo 'Dank voor uw bericht';
    
}

protected function showContent () {
    echo '<p>Uw bericht:</p> 
    <div>Aanhef: '. SALUTATIONS [ $this->data ["salutation"] ] .'</div>    
    <div>Naam: '. $this->data ["name"] .' </div>
    <div>Email: '. $this->data ["email"] .' </div>
    <div>Telefoonnummer: '. $this->data ["phone"] .' </div>
    <div>Communicatievoorkeur: '. COMMPREFS[ $this->data ["commPref"] ].' </div>
    <div>Uw bericht: '. $this->data ["message"] .' </div> ';
}
}