<?php

namespace Qui\middleware;

use Qui\core\Request;
use Qui\core\Response;
use Qui\core\Util;
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
class ExampleMiddleware
{
    public function continue(Request $req, Response $res): bool {
        if (!$req->secure) {
            $res->redirect('/');
            return false;
        }
        return true;
    }
}