<?php

// Used for autoloading
require 'bootstrap.php';

use Qui\controllers\ExampleController;
use Qui\middleware\ExampleMiddleware;
use Qui\Router;

$exampleMiddlewareArray = [ExampleMiddleware::class];

// Add routes here
Router::middleware($exampleMiddlewareArray, [
    [Router::GET, '/something', ExampleController::class],
]);

Router::get('/', ExampleController::class);

// Determine which routes should be used
Router::serve();