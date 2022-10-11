<?php

class HtmlDoc {
    private function beginDocument() 
    { 
        echo '<!doctype html> 
        <html>'; 
    } 

    private function showHeadSection() 
    { 
        echo '<head>'; 
        $this->showHeadContent();
        echo '</head>';
    }

    protected function showHeadContent() {
        echo '<title>Test</title>';        
    }
    
    private function showBodySection() 
    { 
        echo '    <body>' . PHP_EOL; 
        $this->showBodyContent();        
        echo '    </body>' . PHP_EOL; 
    } 

    protected function showBodyContent() {
        echo '<p>Hallo Wereld</p>';
    }

    private function endDocument() 
    { 
        echo  '</html>'; 
    } 

    public function show() {
        $this->beginDocument();
        $this->showHeadSection();
        $this->showBodySection();
        $this->endDocument();
    }
}