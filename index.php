<?php

require 'bootstrap.php';

use TestApp\Test;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

function dd ($data) {
    var_dump($data);
    die;
}

function view($viewNameWithExtension, $data) {
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
    $twig = new Twig_Environment($loader);
    echo $twig->render($viewNameWithExtension, $data);
}

$routes = [
    [
        'path' => '/',
        'controller' => Test::class
    ]
];

foreach ($routes as $route) {
    $path = $_SERVER['REQUEST_URI'];
    $httpRequestType = $_SERVER['REQUEST_METHOD'];

    if ($path == $route['path']) {
        (new $route['controller'])->show();
    }
}