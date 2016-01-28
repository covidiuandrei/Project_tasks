<?php

class Controller {

    public $model;
    public $data;
    public $config;
    public function __construct() {
        global $config;
        $this->config = $config;
        $this->data = array();
        $this->data['title'] = 'Project';
        
    }

    public function render($view) {
        include 'Views/header.php';
        include 'Views/'.$view.'.php';
        include 'Views/footer.php';
    }
    
    public function loadHelper($helper) {
        include 'Helpers/'.$helper.'.php';
    }

}
