<?php

namespace mini;

class View {
    public $layout = 'layout';
    public $header = 'layout/header';
    public $footer = 'layout/footer';
    public $body;
    
    function __construct($view = null, $params = null, $layout = null) {
        if (null !== $params) {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }        
        if (null !== $layout) {
            $this->layout = $layout;
            $this->header = $layout . '/header';
            $this->footer = $layout . '/footer';
        }        
        if (null === $view) {
            if (Mini::$param_number == 0) {
                $this->body = 'index/index';
            } elseif (Mini::$param_number == 1) {
                $this->body = Mini::$params[0] . '/index';
            } else {
                $this->body = Mini::$params[0] . '/' . Mini::$params[1];
            }
        } else {
            if (strpos($view, '/') !== false) {
                $this->body = $view;
            } else {
                $this->body = Mini::$params[0] . '/' . $view;
            }
        }
        
        $this->render();
    }
    
    public function render() {
        $files = [$this->header, $this->body, $this->footer];
        foreach ($files as $file) {
            if (!file_exists(VIEWS_PATH . $file . '.php')) {
                $this->error(MINI_ERR_FILE_NOT_FOUND, VIEWS_PATH . $file . '.php');
                exit;
            }
        }
        foreach ($files as $file) {
            require VIEWS_PATH . $file . '.php';
        }
    }
    
    private function error($err_code, $msg)
    {
        require CONTROLLERS_PATH . 'ErrorController.php';
        Mini::$controller = new \app\controllers\ErrorController();
        Mini::$controller->indexAction($err_code, $msg);
        exit;
    }
}