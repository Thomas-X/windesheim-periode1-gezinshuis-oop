<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 17:50
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\Authentication;
use Qui\lib\facades\DB;
use Qui\lib\facades\Util;
use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;


class LoginController
{
    public function showLogin()
    {
        // GET /login
        View::render('pages.Login');
    }


    // test login:
    // email: thomas@zwarts.codes
    // password: internetcat
    public function onLogin(Request $req, Response $res)
    {
        // POST /login
        Authentication::login($req, $res, $req->params['email'], $req->params['password']);
    }
}