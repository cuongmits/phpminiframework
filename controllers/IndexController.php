<?php

namespace app\controllers;

use mini\Controller;

class IndexController extends Controller 
{
    function __construct() 
    {
        parent::__construct();
    }
    
    function indexAction() 
    {
        //[Optional] Change layout        
        //$this->layout('layout-error');
        
        //3 ways to render:
        //return $this->render(); //without $params
        //return $this->render('index', ['title' => 'This is my Homepage']); //juz [filename], with $params
        return $this->render('index/index', ['title' => 'Hello Homepage!']); //[foldername/filename], with $params
    }
    
    function aboutAction() 
    {
        return $this->render('about');
    }
    
}