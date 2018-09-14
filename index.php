<?php

// Used for autoloading
require 'bootstrap.php';

use Qui\Router;

$exampleMiddlewareArray = ['ExampleMiddleware@next'];

// Add routes here
Router::middleware($exampleMiddlewareArray, [
    [Router::GET, '/something', 'ExampleController@showSomething'],
]);

Router::get('/', 'ExampleController@showHome');

// Determine which routes should be used
Router::serve();