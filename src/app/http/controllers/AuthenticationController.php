<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02/10/18
 * Time: 20:35
 */

namespace Qui\app\http\controllers;


use Qui\lib\Request;
use Qui\lib\Response;

class AuthenticationController
{
    public function showRegister(Request $req, Response $res)
    {
        return View::render('pages.Register');
    }

    public function showLogin(Request $req, Response $res)
    {
        return View::render('pages.Login');
    }

    public function showForgotPassword(Request $req, Response $res)
    {
        return View::render('pages.ForgotPassword', [], 'Wachtwoord vergeten');
    }

    public function onRegister(Request $req, Response $res)
    {
        $success = Authentication::register($req->params);
        // return some error here if success is false
        $res->redirect('/', 200);
    }

    public function onLogin(Request $req, Response $res)
    {
        Authentication::login($req, $res, $req->params['email'], $req->params['password']);
    }

    public function onLogout(Request $req, Response $res)
    {
        Authentication::logout($req, $res);
    }
}