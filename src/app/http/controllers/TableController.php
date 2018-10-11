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

        if (array_key_exists("excludes", $data)) {
            $cols = DB::execute('show COLUMNS from ' . $data['table']);
            $fields = [];
            foreach ($cols as $key => $value) {
                $fields[] = $cols[$key]["Field"];
            }

            foreach ($data["excludes"] as $exclude) {
                if (($key = array_search($exclude, $fields)) !== false) {
                    unset($fields[$key]);
                }
            }

            $fields = implode(",", $fields);
        } else {
            $fields = "*";
        }
        $items = null;
        if (array_key_exists('selectAll', $data)) {
            $items = DB::selectAll($data['table']);
        } else {
            $items = DB::selectWhere($fields, $data["table"], $data['key'], $data['identifier']);
        }
        View::render($data["page"], ['items' => $items]);

    }

    public function create(Request $request, Response $res, $data)
    {
        DB::insertEntry($data['table'], array_merge($request->params));
        $res->redirect('/', 200);
    }

    //update
    public function update(Request $request, Response $res, $data)
    {

        DB::updateEntry($data["id"], $data['table'], array_merge($request->params));
        $res->redirect('/', 200);
    }

    //delete
    public function delete(Request $request, Response $res, $data)
    {
        DB::deleteEntry($data["table"], $data["key"], $data["identifier"]);
        $res->redirect('/', 200);
    }

    public function getall(Request $req, Response $res, $data)
    {

        $allTables = DB::execute('show tables');

        $temp = [];
        foreach ($allTables as $key => $value) {
            $temp[] = $allTables[$key]["Tables_in_mydb"];
        }
        foreach ($data["tables"] as $table) {
            if (($key = array_search($table, $temp)) !== false) {
                $tables[] = $table;
                // unset($tables[$key]);
            }
        }

        View::render($data["page"], ['items' => $allTables]);


    }

}