<?php
define('CONTROLLERS_PATH', '../controllers/');
define('MODELS_PATH', '../models/');
define('VIEWS_PATH', '../views/');
define('MINI_PATH', '../vendor/mini/');

define('MINI_ERR_FILE_NOT_FOUND', 0);
define('MINI_ERR_ACTION_NOT_FOUND', 1);
define('MINI_ERR_PAGE_NOT_FOUND', 2);

require MINI_PATH . 'Controller.php';
require MINI_PATH . 'Model.php';
require MINI_PATH . 'View.php';
require MINI_PATH . 'Database.php';