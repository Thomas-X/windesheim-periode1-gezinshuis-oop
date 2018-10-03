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
    // read
    public function index()
    { 
        $users=DB::selectWhere("*", "users", "roles_id", 1);
        View::render('pages.test',$users);
    }
    // create
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

        print_r("updated");die;
        View::render('pages.test');
    }
    //update
    public function update(Request $request,$id){

        // DB::updateEntry($id,'users',);
    }
    //delete
    public function delete(Request $request,$id){

    }

}