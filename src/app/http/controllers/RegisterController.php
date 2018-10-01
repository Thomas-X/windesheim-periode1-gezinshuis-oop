<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 21:28
 */

namespace Qui\app\http\controllers;

use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\facades\Util;
use Qui\lib\facades\View;
use Qui\lib\facades\Validator;
use Qui\lib\facades\Authentication;

class RegisterController
{
    public function showRegister(Request $req, Response $res)
    {
        return View::render('pages.Register');
    }

    public function onRegister(Request $req, Response $res)
    {
        $success = Authentication::register($req->params);
        // return some error here if success is false
        $res->redirect('/', 200);
    }
}