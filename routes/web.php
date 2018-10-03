<?php

use Qui\lib\App;
use Qui\lib\facades\Router;

$routes = [
    'home' => '/',
    'about' => '/about',
    'contact' => '/contact',
    'login' => '/login',
    'logout' => '/logout',
    'register' => '/register',
    'onRegister' => '/register',
    'CreateMedewerker'=>'/medewerker'
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
Router::get($routes['CreateMedewerker'], 'MedewerkerController@index');

/*
 * POST
 * */
Router::post($routes['login'], 'LoginController@onLogin');
Router::post($routes['onRegister'], 'RegisterController@onRegister');