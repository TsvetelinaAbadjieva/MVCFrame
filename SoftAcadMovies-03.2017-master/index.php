<?php
    session_start();

    DEFINE('MOVIES_PICS_URL', '../uploads/movies');

    require_once __DIR__.'/../common/system/functions.php';

    function __autoload($className)
    {
        if (strpos($className, 'Entity') > 0) {
            $path = __DIR__ . "/../common/models/entities/{$className}.php";
        } elseif (strpos($className, 'Collection') > 0) {
            $path = __DIR__ . "/../common/models/collections/{$className}.php";
        } elseif (strpos($className, 'Controller') > 0) {
            $path = __DIR__ . "/../common/controllers/admin/{$className}.php";
        }else {
            $path = __DIR__."/../common/system/{$className}.php";
        }

        require_once $path;
    }

    $c = (isset($_GET['c']))? $_GET['c'] : 'dashboard';
    $m = (isset($_GET['m']))? $_GET['m'] : 'index';


    $c = ucfirst(strtolower($c)).'Controller';

    if (!class_exists($c)) {
        $c = 'DashboardController';
    }

    $m = strtolower($m);

    $controller = new $c();

    $controller->$m();
