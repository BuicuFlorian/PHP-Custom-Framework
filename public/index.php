<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/core/bootstrap.php';

use App\Core\{Router, Request};

Router::load(dirname(__DIR__) . '/app/routes.php')
    ->direct(Request::uri(), Request::method());