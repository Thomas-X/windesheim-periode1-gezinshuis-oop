<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 21:09
 */

namespace Qui\controllers;


use Qui\core\Authentication;
use Qui\core\facades\Util;
use Qui\core\Request;
use Qui\core\Response;

class LogoutController
{
    public function onLogout($req, $res)
    {
        Authentication::logout($req, $res);
    }
}