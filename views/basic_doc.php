<?php
require_once "html_doc.php";

class BasicDoc extends HtmlDoc {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
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
        foreach ($this->model -> menu as $menuItem) {
        $menuItem -> showMenuItem();
        }
        echo '</ul>' ;
    }

    
    private function showGenericErr() {
            echo '<div class="error">'. $this->model-> genericErr ."</div>";
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