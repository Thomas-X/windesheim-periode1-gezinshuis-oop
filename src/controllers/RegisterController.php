<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 21:28
 */

namespace Qui\controllers;


use Qui\core\Authentication;
use Qui\core\Request;
use Qui\core\Response;
use Qui\core\facades\Util;
use Qui\core\facades\View;
use Qui\core\facades\Validator;

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