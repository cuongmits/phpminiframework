<?php
namespace app\controllers;

use mini\Controller;

class ErrorController extends Controller {
    public $msg = null;
    
    function __construct($err_code = null) {
        parent::__construct();
    }
    
    function indexAction($err_code, $msg)
    {
        if ($err_code === MINI_ERR_FILE_NOT_FOUND) {
            $this->msg = "FILE NOT FOUND: file <code>$msg</code> cannot not be found.";
        } elseif ($err_code === MINI_ERR_ACTION_NOT_FOUND) {
            $this->msg = "ACTION NOT FOUND: action <code>$msg</code> cannot not be found.";
        } elseif ($err_code === MINI_ERR_PAGE_NOT_FOUND) {
            $this->msg = "ERROR 404: Your requested page with url <code>" . Mini::$url . "</code> is not found.";
        }
        
        $this->layout('layout-error');
        $this->render('error/index', ['msg' => $this->msg]);
    }
}
