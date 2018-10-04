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


class TableController
{
    // read
    public function index(Request $req, Response $res, $data)
    { 
        $items=DB::selectWhere("*", $data["table"], $data['key'], $data['identifier']);
        View::render($data["page"],['items'=>$items]);

    }

     public function create(Request $request,Response $res,$data)
    { 
        DB::insertEntry($data['table'], array_merge($request->params));
        $res->redirect('/', 200);
    }
    //update
    public function update(Request $request,Response $res,$data){

        DB::updateEntry($data["id"],$data['table'],array_merge($request->params));
        $res->redirect('/', 200);
    }
    //delete
    public function delete(Request $request,Response $res,$data){
        DB::deleteEntry($data["table"], $data["key"],$data["identifier"]);
        $res->redirect('/',200);
    }

  
}