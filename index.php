<?php

// Used for autoloading
require 'bootstrap.php';

// Imports (via namespaces)
use TestApp\ExampleController;

/*
 * Logic for using the phpdotenv package.
 * All constants declared in .env are stored in a superglobal called $_ENV
 * example:
 * MY_DB_PASSWORD=secret
 *
 * in php:
 * echo $_ENV['MY_DB_PASSWORD']
 * >> secret
 * */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

/*
 * Simple dump and die function stolen from laravel :)
 * */
function dd ($data) {
    var_dump($data);
    die;
}

/*
 * Render a 'view' via Twig, the template engine used
 * */
function view($viewNameWithExtension, $data) {
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
    // Caching could be enabled for fast load times, since uh, well, it's cached. But now very handy when developing
    // Using the new null coaelescene.. ? operator, the ??. Introduced in PHP 7
    // TODO uncomment this for something like a prod env:

//    $cache = ['cache' => __DIR__ . '/cache'];
    $twig = new Twig_Environment($loader, $cache ?? ['cache' => false]);
    echo $twig->render($viewNameWithExtension, $data);
}

/*
 * Routes setup, could be nicer with a class and everything but this works as well.
 * With the controller key the namespaced value of the class is retrieved via the <SomeClass>::class.
 * This is used in the routing logic.
 * */
$routes = [
    [
        'path' => '/',
        'controller' => ExampleController::class
    ]
];

/*
 * Iterate over routes and depending if the path matches the route show the correct controller/method.
 * Since the value of controller is namespaced, make an instance of said controller and call the show() function on it.
 * This can be done since every controller must implement the IController interface
 * TODO add method type checking
 * TODO change API for Controllers so there's a better name for a get / post request (and handle all post values)
 * */
foreach ($routes as $route) {
    $path = $_SERVER['REQUEST_URI'];
    $httpRequestType = $_SERVER['REQUEST_METHOD'];

    if ($path == $route['path']) {
        // TODO add middleware?
        (new $route['controller'])->show();
    }
}