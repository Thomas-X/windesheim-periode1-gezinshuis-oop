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
    public function showHome(Request $req, Response $res, $data)
    {
        $month = [
            1 => "januari",
            2 => "februari",
            3 => "maart",
            4 => "april",
            5 => "mei",
            6 => "juni",
            7 => "juli",
            8 => "augustus",
            9 => "september",
            10 => "oktober",
            11 => "november",
            12 => "december"
        ];

        $days = ['maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag' ];

        $events = DB::execute('SELECT * FROM events LIMIT 3');

        return View::render('pages.Home', compact('events', 'month', 'days'));
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