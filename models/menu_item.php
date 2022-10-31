<?php

class MenuItem {
    private $linkPage; 
    private $labelText;
    private $username;

    public function __construct ($linkPage, $labelText, $username = '') {
        $this->linkPage = $linkPage;
        $this->labelText = $labelText;
        $this->username = $username;
    } 
    
    public function showMenuItem() {
        echo '<li><a HREF="index.php?page=' . $this->linkPage . '">' . $this->labelText. ' ' . $this->username . '</a></li>';
    }
}