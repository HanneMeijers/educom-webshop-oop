<?php
require_once 'thanks_doc.php'; 
class ThanksDoc extends BasicDoc {

protected function showHeader () {
    echo 'Dank voor uw bericht';
    
}

protected function showContent () {
    echo '<p>Bedankt voor uw reactie:</p> 
    <div>Aanhef: '. SALUTATIONS [ $data ["salutation"] ] .'</div>    
    <div>Naam: '. $data ["name"] .' </div>
    <div>Email: '. $data ["email"] .' </div>
    <div>Telefoonnummer: '. $data ["phone"] .' </div>
    <div>Communicatievoorkeur: '. COMMPREFS[ $data ["commPref"] ].' </div>
    <div>Uw bericht: '. $data ["message"] .' </div> ';
}
}