<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 19:53
 */

require 'vendor/autoload.php';

// use namespacing stuff here

use BasicRouting\Router;

$router = new Router();
$router->setRoutes([
    [
        'path' => '/',
        'controller' => 'MyController@showHome'
    ],
    [
        'path' => '/oef',
        'controller' => 'OefController@showOef'
    ]
]);
$router->checkWhichControllerToRun();