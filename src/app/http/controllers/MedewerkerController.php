<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 17:50
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\Authentication;
use Qui\lib\facades\DB;
use Qui\lib\facades\Util;
use Qui\lib\facades\View;
use Qui\lib\Request;


class MedewerkerController
{
    // Home page with all the people
    public function index()
    { 
        $users=DB::selectWhere("*", "users", "roles_id", 1);
        View::render('pages.test',$users);
    }
    // update
    public function create(Request $request)
    { 

        DB::insertEntry('users',  [
            'roles_id' => 1,
            'fname'=> "ik heb nog geen form...",
            'lname'=> "ik heb nog geen form...",
            'email'=> "formless@form.less",
            'mobile'=> "70584564546",
            'password' => "test",
            'rememberMeToken'=>"asd"
        ]);

        print_r("asd");die;
        View::render('pages.test');
    }

}