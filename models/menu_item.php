<?php

class MenuItem {
    private $linkPage, $labelText;
    public function __construct ($linkPage, $labelText) {
        $this->linkPage = $linkPage;
        $this->labelText = $labelText;
    } 
    
    public function showMenuItem() {
        echo '<li><a HREF="index.php?page=' . $this->linkPage . '">' . $this->labelText. '</a></li>';
    }
}