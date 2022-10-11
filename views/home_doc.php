<?php
require_once "basic_doc.php";

class HomeDoc extends BasicDoc {
    
    // override the orgininal method
    protected function showHeader () {
        echo 'RareWines';
    }

    // override the orgininal method
    protected function showContent () {
        echo '
       <h2>Welkom</h2>
     <div>
     Beste lezer, <br>
     <p>Welkom op de website van RareWines.com. In onze webwinkel vindt u exclusieve wijnen van uitzonderlijke kwaliteit. <br>
     Alle wijnen zijn afkomstig uit de kelders van de wijnhuizen zelf, om de herkomst en kwaliteit te garanderen. <br>
     De wijnen worden vanaf aankoop in een gecontroleerde omgeving opgeslagen.
     </p>
    </div> ';
    }
}