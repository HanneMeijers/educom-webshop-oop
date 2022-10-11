<?php
require_once "html_doc.php";

class BasicDoc extends HtmlDoc {

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    private function showBasicHeader() 
    { 
        echo '<h1 class="title">';
        $this->showHeader();     
        echo '</h1>';  
    } 

    protected function showHeader() {
        echo 'Basic';
    }

    private function showMenu ()
    {
        echo '<ul class="navigation">';
        foreach ($this->data['menu'] as $linkPage => $labelText) {
            echo '<li><a HREF="index.php?page=' . $linkPage . '">' . $labelText. '</a></li>';
        }
        echo '</ul>' ;
    }

    
    private function showGenericErr() {
        if (isset($this->data ["genericErr"])) {
            echo '<div class="error">'. $this->data ["genericErr"] ."</div>";
        }
    }
    
    protected function showContent() {
        echo '<p>Basic content</p>';
    }
    
    private function showFooter ()
    {
        echo '<footer>';
        echo '<p><span>&copy;</span> 2022 Author: Hanne Meijers</p>';
        echo '</footer>';
    }

    // override the orgininal method
    protected function showHeadContent() {
        echo "<title>Hanne's Wijnwinkel</title>";
        echo '<link rel="stylesheet" href="CSS\mystyle.css">';
    }

    // override the orgininal method
    protected function showBodyContent() {
        $this->showBasicHeader();
        $this->showMenu(); 
        $this->showGenericErr(); 
        $this->showContent(); 
        $this->showFooter(); 
    }
}