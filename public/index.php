<?php

// Used for autoloading
require __DIR__ . '/../bootstrap.php';

use Qui\core\App;

App::setupRoutes();
App::run();

