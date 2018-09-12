<?php

require 'vendor/autoload.php';

use Jenssegers\Blade\Blade;
use Qui\Database;
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

Database::init();

/*
 * Simple dump and die function, idea stolen from laravel :)
 * */
function dd ($data) {
    var_dump($data);
    die;
}

/*
 * Render a 'view' via Twig, the template engine used
 * */
function view($viewNameWithoutExtension, $data=[]) {
    $blade = new Blade('views', 'cache');
    return $blade->make($viewNameWithoutExtension, $data);
}
