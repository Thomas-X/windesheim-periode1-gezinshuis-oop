<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 19:53
 */

require 'vendor/autoload.php';

// use namespacing stuff here

use Facades\Router;
use Facades\App;
use Facades\View;

$router = new Router();
$view = new View();

App::bind('router', $router);
App::bind('view', $view);

App::get('router')->setRoutes([
    [
        'path' => '/',
        'controller' => 'MyController@showHome'
    ]
]);
App::get('router')->checkWhichControllerToRun();