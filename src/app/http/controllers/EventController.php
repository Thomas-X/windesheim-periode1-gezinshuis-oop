<?php
/**
 * Created by PhpStorm.
 * User: t
 * Date: 05-11-18
 * Time: 20:55
 */

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


class EventController
{
    public function index(Request $req)
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

        $events = DB::execute('SELECT * FROM events LIMIT 6');

        return View::render('pages.event', compact('events', 'month', 'days'));
    }



}