<?php

// Used for (composer) autoloading
require __DIR__ . '/../bootstrap.php';

use Qui\core\App;
use Qui\core\Database;
use Qui\core\View;
use Qui\core\Router;
use Qui\core\Util;
use Qui\core\Validator;

// setup ENV variables before setting up database classes etc
App::setupENV();

$db = new Database();
$util = new Util();
$validator = new Validator();
$view = new View();
$router = new Router();

App::setupDependencies([
    'database'  => $db, // eloquent was used here but now it's not anymore, because packages can't be used
    'pdo'       => $db->pdo,
    'validator' => $validator,
    'view'      => $view,
    'router'    => $router,
    'util'      => $util,
]);
App::setupRoutes();
App::run();

