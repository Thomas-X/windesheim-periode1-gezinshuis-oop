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
use Qui\core\facades\Auth;

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
class ContactController implements IController
{

    // Show contact page
    public function show()
    {
        return View::render('pages.Contact');

    }
}