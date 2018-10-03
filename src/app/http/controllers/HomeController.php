<?php

namespace Qui\app\http\controllers;

use Qui\lib\App;
use Qui\lib\facades\DB;
use Qui\lib\facades\Mailer;
use Qui\lib\facades\NotifierParser;
use Qui\lib\facades\Util;
use Qui\lib\facades\Validator;
use Qui\lib\facades\View;
use Qui\lib\CMailer;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\facades\Authentication;

/*
 * This is an example controller
 * A controller should implement IController to adhere to the API used by the Router.
 * The get() method is called when the handler is called on a GET request
 * The post() method is called when the handler is called on a POST request
 * See index.php for the exact usage of using a controller for a view
 *
 * */

/**
 * Class ExampleController
 * @package Qui\controllers
 */
class HomeController
{
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function showHome(Request $req, Response $res)
    {
        $notify = [
            'notify' => NotifierParser::newNotify()
                ->condition(true)
                ->message('All good!')
                ->newNotify()
                ->condition(false)
                ->message('Not all good!')
        ];
//        dd($notify);

        $users = [
            [
                'name' => 'thomas',
                'fname' => 'zwarts'
            ]
        ];

        $users = DB::selectWhere('*', 'users', 'roles_id', 1);

        return View::render('pages.Test', compact('users'));
//        $id = 1;
//        Util::dd(Auth::login('Thomas', 'internetcat'));
//        $users = DB::execute("SELECT * FROM user WHERE id=?", [$id]);
//        $validation = Validator::isEmail(22)
//            ->isString(1.111)
//            ->isNotNull(null)
//            ->isFloat('nope not a float')
//            ->isString('a string! wooooh!!')
//            ->validate();
//        return $res->json($validation);
    }
}