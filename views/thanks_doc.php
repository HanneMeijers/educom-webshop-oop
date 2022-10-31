<?php
require_once 'basic_doc.php'; 

class ThanksDoc extends BasicDoc {

protected function showHeader () {
    echo 'Dank voor uw bericht';
    
}

protected function showContent () {
    echo '<p>Uw bericht:</p> 
    <div>Aanhef: '. SALUTATIONS [ $this->model ->salutation ] .'</div>    
    <div>Naam: '. $this->model -> name .' </div>
    <div>Email: '. $this->model->email .' </div>
    <div>Telefoonnummer: '. $this->model ->phone .' </div>
    <div>Communicatievoorkeur: '. COMMPREFS[ $this->model ->commPref ].' </div>
    <div>Uw bericht: '. $this->model ->message .' </div> ';
}
}