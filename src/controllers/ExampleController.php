<?php

namespace Qui\controllers;

use Illuminate\Database\Capsule\Manager;
use Qui\Database;
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
    public function get()
    {
        // example
        $id = "1";
        $sql = "SELECT username FROM user WHERE id=?";
        $users = Database::execute($sql, [$id]);

        // example with Eloquent query builder (if that's preferred)
        // for full documentation read Laravel's documentation on it:
        // https://laravel.com/docs/5.7/queries#introduction
        $result = Manager::table('user')
            ->where('id', '>=', $id)
            ->get();

        dd($result);

        return view('index', compact('users'));
    }

    public function post()
    {
        return json_encode([
            'message' => 'hello world'
        ]);

        // TODO: Implement post() method.
    }
}