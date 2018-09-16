<?php

require 'vendor/autoload.php';

use Qui\core\App;
use Qui\core\Database;
use Qui\core\Request;
use Qui\core\View;
use Qui\core\Router;
use Qui\core\Util;
use Qui\core\Validator;

/*
 * Logic for using the phpdotenv package.
 * All constants declared in .env are stored in a superglobal called $_ENV and in $_SERVER
 * example:
 * MY_DB_PASSWORD=secret
 *
 * in php:
 * echo $_ENV['MY_DB_PASSWORD']
 * >> secret
 * */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$db = new Database();
$util = new Util();
$validator = new Validator();
$view = new View();
$router = new Router();

// Bindings for facades to app DI container
App::bind('env', $_ENV);
App::bind('database', $db->eloquent);
App::bind('pdo', $db->pdo);
App::bind('validator', $validator);
App::bind('view', $view);
App::bind('router', $router);
App::bind('util', $util);
App::bindMethod('dd', 'dd', Util::class);