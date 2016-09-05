<?php

namespace mini;

use mini\View;

class Controller {
    
    public $view;
    public $layout = null;
    public $model;
    
    function __construct() {
        $file = MODELS_PATH . ucfirst(Mini::$params[0]) . 'Model.php';
        if (file_exists($file)) {
            require $file;
            $model = '\app\models\\' . ucfirst(Mini::$params[0]) . 'Model';
            $this->model = new $model();
        }
    }
    
    public function layout($layout) 
    {
        $this->layout = $layout;
    }

    public function render($view = null, $params = null)
    {
        $this->view = new View($view, $params, $this->layout);
    }
}