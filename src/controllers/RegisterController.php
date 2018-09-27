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

class RegisterController
{
    public function showRegister(Request $req, Response $res)
    {
        // temp override for mocking
        $req->params = [
            'fname' => 'thomaszz',
            'lname' => 'zwartzzz',
            'email' => 'h4ck3r@mail.com',
            'mobile' => '0612345678',
            'roles_id' => 1,
            'password' => 'internetcat',
        ];
        Authentication::register($req, $res);
        return View::render('pages.Home');
    }
}