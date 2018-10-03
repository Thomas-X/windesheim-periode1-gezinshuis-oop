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
 *
 * No middleware routes should be placed before middleware routes (is nice)
 *
 * */

/*
 * GET
 * */
Router::get($routes['home'], 'HomeController@showHome');
Router::get($routes['about'], 'AboutController@showAbout');
Router::get($routes['contact'], 'ContactController@showContact');

/*
 *
 * MIDDLEWARE
 *
 * */

/*
 * Forgot password token verification middleware
 * */
Router::middleware(['AuthenticationMiddleware@resetPassword'], [
    [
        App::GET, $routes['resetPassword'], 'AuthenticationController@showResetPassword'
    ],
    [
        App::POST, $routes['resetPassword'], 'AuthenticationController@onResetPassword'
    ]
]);

/*
 * Should be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldBeLoggedIn'], [
    [
        App::GET, $routes['logout'], 'AuthenticationController@onLogout'
    ]
]);

/*
 * Should not be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldNotBeLoggedIn'], [
    [
        App::GET, $routes['login'], 'AuthenticationController@showLogin'
    ],
    [
        App::GET, $routes['register'], 'AuthenticationController@showRegister'
    ],
    [
        App::GET, $routes['forgotPassword'], 'AuthenticationController@showForgotPassword'
    ],
    [
        App::POST, $routes['login'], 'AuthenticationController@onLogin'
    ],
    [
        App::POST, $routes['onRegister'], 'AuthenticationController@onRegister'
    ],
    [
        App::POST, $routes['forgotPassword'], 'AuthenticationController@onForgotPassword'
    ]
]);
