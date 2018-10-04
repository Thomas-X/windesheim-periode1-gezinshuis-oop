<?php

use Qui\lib\App;
use Qui\lib\facades\Router;
use Qui\lib\Request;
$routes = [
    'home' => '/',
    'about' => '/about',
    'contact' => '/contact',
    'login' => '/login',
    'logout' => '/logout',
    'register' => '/register',
    'onRegister' => '/register',
    'resetPassword' => '/resetpassword',
    'forgotPassword' => '/forgotpassword',
    'CreateMedewerker'=>'/medewerker',
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
Router::get($routes['login'], 'AuthenticationController@showLogin');
Router::get($routes['logout'], 'AuthenticationController@onLogout');
Router::get($routes['register'], 'AuthenticationController@showRegister');
Router::get($routes['forgotPassword'], 'AuthenticationController@showForgotPassword');
Router::get($routes['onRead'], 'TableController@index',['table'=>'users','key'=>'roles_id','identifier'=>1,"page"=>"pages.Test"]);
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
// TODO implement this (I have no time left to do this)
//Router::middleware(['AuthenticationMiddleware@shouldNotBeLoggedIn'], [
//    [
//
//    ]
//]);
Router::get($routes['login'], 'LoginController@showLogin');
Router::get($routes['logout'], 'LogoutController@onLogout');
Router::get($routes['register'], 'RegisterController@showRegister');
Router::get($routes['CreateMedewerker'], 'MedewerkerController@index');

/*
 * POST
 * */
Router::post($routes['login'], 'AuthenticationController@onLogin');
Router::post($routes['onRegister'], 'AuthenticationController@onRegister');
Router::post($routes['forgotPassword'], 'AuthenticationController@onForgotPassword');
Router::post($routes['CreateMedewerker'], 'MedewerkerController@create');
Router::post($routes['onCreate'], 'TableController@create',['table'=>'users']);
Router::post($routes['onUpdate'], 'TableController@update',['table'=>'users','id'=>1]);
Router::post($routes['onDelete'], 'TableController@delete',['table'=>'users','key'=>'id','identifier'=>6]);


//Router::get($routes['home'], 'HomeController@showHome', [ 'table' => 'users', 'excludes' => ['roles_id', 'fname'] ]);
