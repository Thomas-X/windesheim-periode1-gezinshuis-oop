<?php

use Qui\lib\App;
use Qui\lib\facades\Router;
use Qui\lib\Routes;

/*
 *
 * No middleware routes should be placed before middleware routes (is nice)
 *
 * */

//    'showUpload' => '/upload',
//    'upload' => '/upload'
//Router::get($routes['showUpload'], 'TreatmentDocumentController@showUpload');
// Router::post($routes['upload'], 'TreatmentDocumentController@upload');
/*
 * GET
 * */
Router::get(Routes::routes['home'], 'HomeController@showHome');
Router::get(Routes::routes['about'], 'AboutController@showAbout');
Router::get(Routes::routes['contact'], 'ContactController@showContact');

// Table controller usage
//Router::get($routes['onRead'], 'TableController@index',['table'=>'users','selectAll' => null,"page"=>"pages.Test","excludes"=>['id',"fname"]]);
//Router::get($routes['onReadAll'], 'TableController@getall',['tables'=>['users','roles'],"page"=>"pages.Test"]);
//Router::post($routes['CreateMedewerker'], 'MedewerkerController@create');
//Router::post($routes['onCreate'], 'TableController@create',['table'=>'users']);
//Router::post($routes['onUpdate'], 'TableController@update',['table'=>'users','id'=>1]);
//Router::post($routes['onDelete'], 'TableController@delete',['table'=>'users','key'=>'id','identifier'=>6]);
// Router::get($routes['CreateMedewerker'], 'MedewerkerController@index');
//'onReadAll'=>'/tables',
//    'onRead'=>'/tables/test',
//    'onCreate'=>'/tables/test/create',
//    'onUpdate'=>'/tables/test/update',
//    'onDelete'=>'/tables/test/delete',
//    'CreateMedewerker'=>'/medewerker',


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
        App::GET, Routes::routes['resetPassword'], 'AuthenticationController@showResetPassword'
    ],
    [
        App::POST, Routes::routes['resetPassword'], 'AuthenticationController@onResetPassword'
    ]
]);

/*
 * Should be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldBeLoggedIn'], [
    [
        App::GET, Routes::routes['logout'], 'AuthenticationController@onLogout'
    ]
]);
Router::get(Routes::routes['login'], 'LoginController@showLogin');
Router::get(Routes::routes['logout'], 'LogoutController@onLogout');
Router::get(Routes::routes['register'], 'RegisterController@showRegister');

/*
 * Should not be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldNotBeLoggedIn'], [
    [
        App::GET, Routes::routes['login'], 'AuthenticationController@showLogin'
    ],
    [
        App::GET, Routes::routes['register'], 'AuthenticationController@showRegister'
    ],
    [
        App::GET, Routes::routes['forgotPassword'], 'AuthenticationController@showForgotPassword'
    ],
    [
        App::POST, Routes::routes['login'], 'AuthenticationController@onLogin'
    ],
    [
        App::POST, Routes::routes['onRegister'], 'AuthenticationController@onRegister'
    ],
    [
        App::POST, Routes::routes['forgotPassword'], 'AuthenticationController@onForgotPassword'
    ]
]);
//Router::get($routes['home'], 'HomeController@showHome', [ 'table' => 'users', 'excludes' => ['roles_id', 'fname'] ]);