<?php
require_once 'basic_doc.php'; 
class AboutDoc extends BasicDoc {

protected function showHeader () {
    echo 'Over Mij';
    
}

protected function showContent () {
    echo '<p> Tijdens een vakantie in Italië (2019) raakte ik geïnteresseerd in exclusieve wijnen. Deze hobby is uit de hand gelopen. Vandaar deze website, ik verkoop mijn wijnen graag aan liefhebbers. </p>';
    
}
}