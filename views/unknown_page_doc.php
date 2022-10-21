<?php
require_once "basic_doc.php";

class UnknownPageDoc extends BasicDoc {
    protected function showHeader ()
    {
        echo 'Page not found';
    }
    protected function showContent()
    {
        echo 'Deze pagina is niet gevonden, klik op Home';
    }
}