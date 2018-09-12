<?php

// Used for autoloading
require 'bootstrap.php';

use Qui\controllers\ExampleController;
use Qui\middleware\ExampleMiddleware;
use Qui\Router;

$exampleMiddlewareArray = [ExampleMiddleware::class];

Router::post('/example', ExampleController::class);

// Add routes here
Router::middleware($exampleMiddlewareArray, function () {

    Router::get('/', ExampleController::class);
});

// Determine which routes should be used (and which shouldn't depending on the outcome of middleware)
Router::serve();