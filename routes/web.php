<?php

use Qui\core\App;
use Qui\core\facades\Router;

$routes = [
    'home' => '/',
    'about' => '/about',
    'contact' => '/contact'
];

//$middleware = ['ExampleMiddleware@continue'];

//Router::middleware($middleware, [
//[App::GET, $routes['something'], 'ExampleController@showSomething']
//]);

Router::get($routes['home'], 'HomeController@showHome');
Router::get($routes['about'], 'AboutController@showAbout');
Router::get($routes['contact'], 'ContactController@showContact');