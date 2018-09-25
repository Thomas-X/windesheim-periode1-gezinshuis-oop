<?php

use Qui\core\App;
use Qui\core\facades\Router;

$routes = [
    'home' => '/',
    'something' => '/something'
];

$middleware = ['ExampleMiddleware@continue'];

Router::middleware($middleware, [
[App::GET, $routes['something'], 'ExampleController@showSomething']
]);

Router::get($routes['home'], 'ExampleController@showHome');