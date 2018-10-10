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
use Qui\lib\Response;


class MedewerkerController
{
    // read
    public function index()
    { 
        $users=DB::selectWhere("*", "users", "roles_id", 1);
        View::render('pages.Test',['users'=>$users]);

    }
    // create
    public function create(Request $request,$res)
    { 
        $success = Authentication::register($request->params);
        // return some error here if success is false
        $res->redirect('/', 200);
    }
    //update
    public function update(Request $request,$res){

        DB::updateEntry($request->params["id"],'users',array_merge($request->params, [
            'password' => Authentication::generateHash($request->params['password'])
        ]));
        $res->redirect('/', 200);
    }
    //delete
    public function delete(Request $request,$id){

    }

}