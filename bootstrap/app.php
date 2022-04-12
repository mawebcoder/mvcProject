<?php

use bootstrap\Routing;
use App\Models\Model;

/**
 * load configs
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/app.php';


/**
 * load autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';




/**
 * connect to database
 */
$model = new Model();

/**
 * run routing system
 */
$routing = new Routing();


$routing->run();




