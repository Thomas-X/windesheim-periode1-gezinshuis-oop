<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 17:50
 */

namespace Qui\controllers;


use Qui\core\Authentication;
use Qui\core\facades\DB;
use Qui\core\facades\Util;
use Qui\core\facades\View;
use Qui\core\Request;
use Qui\core\Response;


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