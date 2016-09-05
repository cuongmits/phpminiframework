<?php

// comment out the following two lines when deployed to production
defined('MINI_DEBUG') or define('MINI_DEBUG', true);
defined('MINI_ENV') or define('MINI_ENV', 'dev');

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../vendor/mini/Mini.php';

$config = require __DIR__.'/../config/config.php';

(new mini\Mini($config))->start();


