<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 23:46
 */

namespace Qui\app\http\middleware;


use Qui\lib\facades\Authentication;
use Qui\lib\Request;
use Qui\lib\Response;

class RequestValidatorMiddleware
{
    public function isLoggedInAsEmployee(Request $req, Response $res)
    {
        dd(Authentication::verify(true));
        return true;
    }
}