<?php

use Qui\core\App;
use Qui\core\facades\Router;

$routes = [
    'home' => '/',
    'about' => '/about',
    'contact' => '/contact',
    'login' => '/login',
    'logout' => '/logout',
    'register' => '/register',
];

//$middleware = ['ExampleMiddleware@continue'];

//Router::middleware($middleware, [
//[App::GET, $routes['something'], 'ExampleController@showSomething']
//]);

/*
 * GET
 * */
Router::get($routes['home'], 'HomeController@showHome');
Router::get($routes['about'], 'AboutController@showAbout');
Router::get($routes['contact'], 'ContactController@showContact');
Router::get($routes['login'], 'LoginController@showLogin');
Router::get($routes['logout'], 'LogoutController@onLogout');
Router::get($routes['register'], 'RegisterController@showRegister');

/*
 * POST
 * */
Router::post($routes['login'], 'LoginController@onLogin');