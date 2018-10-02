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
    'resetPassword' => '/resetpassword',
    'forgotPassword' => '/forgotpassword'
];

/*
 * GET
 * */
Router::get($routes['home'], 'HomeController@showHome');
Router::get($routes['about'], 'AboutController@showAbout');
Router::get($routes['contact'], 'ContactController@showContact');
Router::get($routes['login'], 'AuthenticationController@showLogin');
Router::get($routes['logout'], 'AuthenticationController@onLogout');
Router::get($routes['register'], 'AuthenticationController@showRegister');
Router::get($routes['forgotPassword'], 'AuthenticationController@showForgotPassword');

/*
 * MIDDLEWARE
 * */
Router::middleware(['AuthenticationMiddleware@resetPassword'], [
    [
        App::GET, $routes['resetPassword'], 'AuthenticationController@showResetPassword'
    ],
    [
        App::POST, $routes['resetPassword'], 'AuthenticationController@onResetPassword'
    ]
]);

// If the user should NOT be logged in (i.e login/register page should be hidden)
// TODO remove /register page but for tmp testing its useful
Router::middleware(['AuthenticationMiddleware@shouldNotBeLoggedIn'], [
    [

    ]
]);

/*
 * POST
 * */
Router::post($routes['login'], 'AuthenticationController@onLogin');
Router::post($routes['onRegister'], 'AuthenticationController@onRegister');
Router::post($routes['forgotPassword'], 'AuthenticationController@onForgotPassword');
