<?php
namespace mini;

//TO-DO: need to devide Mini class to subclasses

class Mini {
    
    public static $params;
    public static $param_number;
    public static $controller;
    public static $method = 'indexAction';
    public static $url;
    public static $view;
    public static $db;
    
    function __construct($config = []) {
        //TODO: config
        Mini::$url = $config['url'];
        Mini::$db = $config['db'];
    }
    
    public function start() 
    {
        $this->urlProcess();
        if (Mini::$param_number == 0) {
            $this->loadDefaultController();
        } else {
            $this->loadController();
        }
    }
    
    private function urlProcess()
    {
        $params = isset($_GET['url']) ? $_GET['url'] : null;
        if ($params === null) {
            Mini::$param_number = 0;
        } else {
            $params = rtrim($params, '/');
            $params = filter_var($params, FILTER_SANITIZE_URL);
            Mini::$params = explode('/', $params);
            Mini::$param_number = count(Mini::$params);
            if (Mini::$param_number > 1) {
                Mini::$method = Mini::$params[1] . 'Action';
            }
        }
    }
    
    /**
     * load default controller/method 'index/index'
     */
    private function loadDefaultController() 
    {
        require CONTROLLERS_PATH . 'IndexController.php';
        Mini::$controller = new \app\controllers\IndexController();
        if ($this->isGetRequest()) {
            Mini::$controller->indexAction();
        } else {
            Mini::$controller->indexAction($_POST);
        }
    }
    
    private function loadController()
    {
        $file = CONTROLLERS_PATH . ucfirst(Mini::$params[0]) . 'Controller.php';
        
        if (!file_exists($file)) {
            $this->error(MINI_ERR_FILE_NOT_FOUND, $file);
            return false;
        }
        
        require $file;
        $class = '\app\controllers\\' . ucfirst(Mini::$params[0]) . 'Controller';
        Mini::$controller = new $class();

        if (Mini::$param_number > 1) {
            if (!method_exists(Mini::$controller, Mini::$method)) {                
                $this->error(MINI_ERR_ACTION_NOT_FOUND, Mini::$method);
            }
        }

        if ($this->isGetRequest())
        {
            switch (Mini::$param_number) {
                case 5:
                    Mini::$controller->{Mini::$method}(Mini::$params[2], Mini::$params[3], Mini::$params[4]);
                    break;
                case 4:
                    Mini::$controller->{Mini::$method}(Mini::$params[2], Mini::$params[3]);
                    break;
                case 3:
                    Mini::$controller->{Mini::$method}(Mini::$params[2]);
                    break;
                case 2:
                    Mini::$controller->{Mini::$method}();
                    break;
                default:
                    Mini::$controller->indexAction();
                    break;
            }
        } elseif ($this->isPostRequest()) 
        {
            switch (Mini::$param_number) {
                case 5:
                    Mini::$controller->{Mini::$method}(Mini::$params[2], Mini::$params[3], Mini::$params[4], $_POST);
                    break;
                case 4:
                    Mini::$controller->{Mini::$method}(Mini::$params[2], Mini::$params[3], $_POST);
                    break;
                case 3:
                    Mini::$controller->{Mini::$method}(Mini::$params[2], $_POST);
                    break;
                case 2:
                    Mini::$controller->{Mini::$method}($_POST);
                    break;
                default:
                    Mini::$controller->indexAction($_POST);
                    break;
            }
        }

    }

    private function error($err_code, $msg) //TODO: duplicate in View
    {
        require CONTROLLERS_PATH . 'ErrorController.php';
        Mini::$controller = new \app\controllers\ErrorController();
        Mini::$controller->indexAction($err_code, $msg);
        exit;
    }

    public static function getUrl($param = null)
    {
        return null === $param ? Mini::$url : Mini::$url . $param;
    }
    
    public static function isShortUrl($param = null)
    {
        if (Mini::$param_number == 0) {
            $currentShortUrl = 'index/index';
        } elseif (Mini::$param_number ==1) {
            $currentShortUrl = Mini::$params[0] . '/index';
        } else {
            $currentShortUrl = Mini::$params[0] . '/' . Mini::$params[1];
        }
        if (null === $param) {
            $param = 'index/index';
        }
        if ($param === $currentShortUrl) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function isGetRequest()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET' ? true : false;
    }
    
    public static function isPostRequest()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' ? true : false;
    }
    
    public static function isAjaxRequest() 
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') ? true : false;
    }
    
    public static function postData()
    {
        //TO-DO: validate $_POST data
        return $_POST;
    }
}
