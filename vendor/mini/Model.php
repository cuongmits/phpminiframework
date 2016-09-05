<?php

namespace mini;

use mini\Database;

//TO-Do: It will be better to deploy Some general methods (using by all models) here

class Model {
    static public $db;
    
    function __construct() {
        Model::$db = new Database();
    }
    
    public function load($data)
    {
        //TO-DO
    }
    
    public function save() 
    {
        //TO-DO
    }

    static function find($condition)
    {
        //TO-DO
    }
}