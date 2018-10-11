<?php

use Qui\lib\App;
use Qui\lib\facades\Router;
use Qui\lib\Routes;
use Qui\lib\Request;
use Qui\lib\Response;

/*
 *
 * No middleware routes should be placed before middleware routes (is nice)
 *
 * */

//    'showUpload' => '/upload',
//    'upload' => '/upload'
//Router::get($routes['showUpload'], 'CareForSchemaController@showUpload');
// Router::post($routes['upload'], 'CareForSchemaController@upload');
/*
 * GET
 * */
Router::get(Routes::routes['home'], 'HomeController@showHome');
Router::get(Routes::routes['about'], 'AboutController@showAbout');
Router::get(Routes::routes['contact'], 'ContactController@showContact');

function CMS_BUILDER()
{
    $req = new Request();
    $res = new Response();

    if (array_key_exists('type', $req->params)) {
        switch ($req->params['type']) {
            case 'select':
                Router::get(
                    Routes::routes['cms_day2dayInformation'],
                    'TableController@index',
                    [
                        'table' => 'day2dayinformation',
                        'key' => 'id',
                        'identifier' => $req->params['id'],
                        "page" => "pages.day2day.index"
                    ]);
                break;
            case 'create':
                Router::post(
                    Routes::routes['cms_day2dayInformation'],
                    'TableController@create',
                    ['table' => 'day2dayinformation']);
                break;
            case 'update':
                Router::post(Routes::routes['cms_day2dayInformation'], 'TableController@update', ['table' => 'day2dayinformation',
                    'id' => $req->params['id']]);
                break;
            case 'delete':
                Router::post(Routes::routes['cms_day2dayInformation'], 'TableController@delete', ['table' => 'day2dayinformation',
                    'identifier' => $req->params['id'],
                    'key' => 'id']);
                break;
        }
    } else {
        Router::get(Routes::routes['cms_day2dayInformation'], 'TableController@index', ['table' => 'day2dayinformation',
            'selectAll' => null,
            "page" => "pages.day2day.index"]);
    }
}

CMS_BUILDER();


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
        App::GET,
        Routes::routes['resetPassword'],
        'AuthenticationController@showResetPassword'
    ],
    [
        App::POST,
        Routes::routes['resetPassword'],
        'AuthenticationController@onResetPassword'
    ]
]);

/*
 * Should be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldBeLoggedIn'], [
    [
        App::GET,
        Routes::routes['logout'],
        'AuthenticationController@onLogout'
    ],
    [
        App::GET,
        Routes::routes['careForSchemas'],
        'CareForSchemaController@showCareForSchemas'
    ],
    [
        App::POST,
        Routes::routes['uploadCareForSchema'],
        'CareForSchemaController@careForSchemasFile'
    ],
    [
        App::POST,
        Routes::routes['downloadCareForSchema'],
        'CareForSchemaController@careForSchemasFile'
    ]
]);

/*
 * Should not be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldNotBeLoggedIn'], [
    [
        App::GET,
        Routes::routes['login'],
        'AuthenticationController@showLogin'
    ],
    [
        App::GET,
        Routes::routes['register'],
        'AuthenticationController@showRegister'
    ],
    [
        App::GET,
        Routes::routes['forgotPassword'],
        'AuthenticationController@showForgotPassword'
    ],
    [
        App::POST,
        Routes::routes['login'],
        'AuthenticationController@onLogin'
    ],
    [
        App::POST,
        Routes::routes['onRegister'],
        'AuthenticationController@onRegister'
    ],
    [
        App::POST,
        Routes::routes['forgotPassword'],
        'AuthenticationController@onForgotPassword'
    ]
]);
//Router::get($routes['home'], 'HomeController@showHome', [ 'table' => 'users', 'excludes' => ['roles_id', 'fname'] ]);