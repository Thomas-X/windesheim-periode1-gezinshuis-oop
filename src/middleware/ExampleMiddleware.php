<?php

namespace Qui\middleware;

use Qui\interfaces\IMiddleware;

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/09/18
 * Time: 19:06
 */

/*
 * This is an example middleware, middleware should always implement IMiddleware
 * The next method gets called and depending on the outcome different things happen.
 *
 * if false:
 *      stop request and respond with a 401 unauthorized
 * if true:
 *      just keep on truckin' on (adding the routes to the routes array to be served)
 * */
class ExampleMiddleware implements IMiddleware
{
    public function next(): bool {
        return true;
    }
}