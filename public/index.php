<?php

// Used for (composer) autoloading
require __DIR__ . '/../bootstrap.php';

use Qui\lib\App;
use Qui\lib\Database;
use Qui\lib\CView;
use Qui\lib\CRouter;
use Qui\lib\CUtil;
use Qui\lib\CAuthentication;
use Qui\lib\CValidator;

$_ENV = [];
// setup ENV variables before setting up database classes etc
App::setupENV();

$db = new Database();
$util = new CUtil();
$validator = new CValidator();
$view = new CView();
$router = new CRouter();
$auth = new CAuthentication();

App::setupDependencies([
    'database'  => $db, // eloquent was used here but now it's not anymore, because packages can't be used
    'pdo'       => $db->pdo,
    'validator' => $validator,
    'view'      => $view,
    'router'    => $router,
    'util'      => $util,
    'authentication'      => $auth,
]);
App::setupRoutes(__DIR__ . '/../routes/web.php');
App::run();

