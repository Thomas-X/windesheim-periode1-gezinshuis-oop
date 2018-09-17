<?php

namespace Qui\controllers;

use Qui\core\App;
use Qui\core\facades\DB;
use Qui\core\facades\Util;
use Qui\core\facades\Validator;
use Qui\core\facades\View;
use Qui\core\Request;
use Qui\core\Response;
use Qui\interfaces\IController;

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
class ExampleController implements IController
{

    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function showHome(Request $req, Response $res)
    {
        $users = DB::execute("SELECT * FROM user", []);
        return View::render('pages.Home', compact('users'));
    }

    /**
     * @return string
     */
    public function showSomething()
    {
        return View::render();
    }

}