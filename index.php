<?php

// Used for autoloading
require 'bootstrap.php';

use Qui\core\App;
use Qui\core\facades\Router;

$middleware = ['ExampleMiddleware@continue'];

Router::middleware($middleware, [
    [App::GET, '/something', 'ExampleController@showSomething']
]);

Router::get('/', 'ExampleController@showHome');

// Determine which routes should be used
Router::serve();