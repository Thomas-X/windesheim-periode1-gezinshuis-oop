<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02/10/18
 * Time: 20:35
 */

namespace Qui\app\http\controllers;


use Qui\lib\facades\Authentication;
use Qui\lib\facades\DB;
use Qui\lib\facades\Mailer;
use Qui\lib\facades\NotifierParser;
use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\Routes;

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
    public function showBeheer(Request $req, Response $res)
    {
        return View::render('pages.Beheer');
    }
    public function showAdd(Request $req, Response $res)
    {
        return View::render('pages.Add');
    }
    public function showEdit(Request $req, Response $res)
    {
        return View::render('pages.Edit');
    }
    public function showDelete(Request $req, Response $res)
    {
        return View::render('pages.Delete');
    }
    public function showForgotPassword(Request $req, Response $res)
    {
        return View::render('pages.ForgotPassword', [], 'Wachtwoord vergeten');
    }

    public function showResetPassword(Request $req, Response $res)
    {
        return View::render('pages.ResetPassword', [], 'Wachtwoord resetten');
    }

    public function onResetPassword(Request $req, Response $res)
    {
        $forgotPasswordToken = $req->params['forgotPasswordToken'];
        $home = Routes::$routes['home'];
        $password = $req->params['password'];
        if (!isset($password) || !isset($forgotPasswordToken)) {
            return $res->redirect($home, 401);
        }
        // TODO DRY i know
        $users = DB::selectWhere('email, id', 'users', 'forgotPasswordToken', $req->params['forgotPasswordToken']);
        if (!isset($users)) {
            return $res->redirect($home, 401);
        } else if (count($users) > 1) {
            return $res->redirect($home, 401);
        }
        $user = $users[0];
        $password = Authentication::generateHash($password);
        DB::updateEntry($user['id'], 'users', compact('password'));
        NotifierParser::init()
            ->newNotification()
            ->success()
            ->message('<div style="display:flex;align-items: center">Je wachtwoord is geupdate!</div>');
        return $this->showResetPassword($req, $res);
    }

    public function onForgotPassword(Request $req, Response $res)
    {
        $home = Routes::$routes['home'];
        if (!isset($req->params['email'])) $res->redirect($home);

        $users = DB::selectWhere('email, id', 'users', 'email', $req->params['email']);
        if (!isset($users)) {
            return $res->redirect($home, 401);
        }
        $user = $users[0];
        $forgotPasswordToken = Authentication::generateRandomString();
        DB::updateEntry($user['id'], 'users', compact('forgotPasswordToken'));
        Mailer::setupMail()
            ->to($user['email'])
            ->subject('Reset password')
            ->body("<html lang='en'><body><h3>Klik op deze <a href='http://localhost:8000/resetpassword?forgotPasswordToken={$forgotPasswordToken}'>link</a> om je wachtwoord te resetten</h3><br/><h5>Met vriendelijke groet, <br/><br/> Team 11</h5></body></html>")
            ->send();

        NotifierParser::init()
            ->newNotification()
            ->success()
            ->message('<div style="display:flex;align-items: center"><i class="fas fa-envelope"></i><div class="margin-1"></div>Check je inbox voor een mail!</div>');
        return $this->showForgotPassword($req, $res);
    }

    public function onRegister(Request $req, Response $res)
    {
        $success = Authentication::register($req->params);
        // return some error here if success is false
        $res->redirect(Routes::$routes['home'], 200);
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