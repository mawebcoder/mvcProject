<?php

use App\bootstrap\Routing;

require_once __DIR__ . '/Routing.php';

require_once __DIR__ . '/../app/http/Controllers/Controller.php';

/**
 * run routing system
 */
$routing = new Routing();


$routing->run();

