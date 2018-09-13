<?php

require 'vendor/autoload.php';

use Jenssegers\Blade\Blade;
use Qui\Database;
use Illuminate\Database\Capsule\Manager as DB;

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

// Initialize database connection
Database::init();

/*
 * Simple dump and die function, idea stolen from laravel :)
 * */
function dd ($data) {
    var_dump($data);
    die;
}

/*
 * Render a 'view' via Blade, the template engine used
 * */
function view($viewNameWithoutExtension, $data=[]) {
    $blade = new Blade('views', 'cache');
    return $blade->make($viewNameWithoutExtension, $data);
}
