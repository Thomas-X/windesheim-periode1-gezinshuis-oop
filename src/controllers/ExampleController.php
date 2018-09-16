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
class ExampleController implements IController
{

    public function showHome(Request $req, Response $res)
    {
//        $users = DB::table('user')->get();
//        return View::render('index', compact('users'));

        $validation = Validator::isEmail(8789)->isString(22)->validate();
        return $res->json(compact('validation'));
    }

    public function showSomething()
    {
        return 'hello';
    }

}