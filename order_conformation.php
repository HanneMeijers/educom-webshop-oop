<?php
function showOrderconformationHeader() {
    echo 'Bestelbevestiging';
}

function showOrderConformation ($data) { 
echo '<p>Bedankt voor uw bestelling. <br>
 Uw bestelnummer is: '. $data ['invoice_number'].' <br>
 De bevestiging wordt gemaild naar: '. $data ['email'].'</p>';
}