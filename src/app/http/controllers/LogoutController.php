<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 21:09
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\Util;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\facades\Authentication;

class LogoutController
{
    public function onLogout($req, $res)
    {
        Authentication::logout($req, $res);
    }
}