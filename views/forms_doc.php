<?php
require_once "basic_doc.php";
abstract class FormsDoc extends BasicDoc {
    
    protected function showContent() {

        echo '<form method="post" action="index.php">';
        $this->showFormContent();
        echo '<input type="hidden" name="page" value="'.$this->model -> page.'">';
        echo '</form>';
    }

    abstract protected function showFormContent();   
}