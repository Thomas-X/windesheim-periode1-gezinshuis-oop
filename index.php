<?php

// Used for autoloading
require 'bootstrap.php';

use Qui\controllers\ExampleController;
use Qui\Router;

// Add routes here
Router::get('/', ExampleController::class);
Router::post('/example', ExampleController::class);

// Determine which routes should be used
Router::serve();