<?php

namespace Qui\controllers;

use Qui\Database;
use Qui\interfaces\IController;


class ExampleController implements IController
{
    public function show()
    {
        // example:
        $id = "1";
        $sql = "SELECT username FROM user WHERE id=?";
        $users = Database::execute($sql, [$id]);
//        dd($users);
        return view('index', ['users' => $users]);
    }

    public function post()
    {
        return json_encode([
            'message' => 'hello world'
        ]);

        // TODO: Implement post() method.
    }
}