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
use Qui\lib\Routes;


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

    public function create_get(Request $req, Response $res, array $data)
    {
        $extraData = $data['create_get_includes_data'] ?? null;
        View::render($data['page'], $extraData
            ? ['create_get_includes_data' => $extraData]
            : []
        );
    }

    public function update_get(Request $req, Response $res, array $data)
    {
        $items = DB::selectWhere('*', $data["table"], $data['key'], $data['identifier']);
        $items = $items[0];
        View::render($data['page'], [
            'fieldData' => $items,
            'update_get_includes_data' => $data['update_get_includes_data']
        ]);
    }


    public function create_post(Request $req, Response $res, $data)
    {
        $dbData = [];
        foreach ($data['includes'] as $include) {
            $dbData[$include] = $req->params[$include];
        }
        foreach ($data['includes_data'] as $key => $includeData) {
            $dbData[$key] = $includeData;
        }
        DB::insertEntry($data['table'], $dbData);
        $res->redirect($data['redirect'], 200);
    }

    //update
    public function update_post(Request $request, Response $res, $data)
    {

        DB::updateEntry($data["id"], $data['table'], array_merge($request->params));
        $res->redirect($data['redirect'], 200);
    }

    //delete
    public function delete_post(Request $request, Response $res, $data)
    {
        DB::deleteEntry($data["table"], $data["key"], $data["identifier"]);
        $res->redirect($data['redirect'], 200);
    }

    private function getallTablesCount($aliasTables)
    {

        $allTables = DB::execute('show tables');
        $temp = [];
        foreach ($allTables as $key => $value) {
            $val = $allTables[$key]["Tables_in_mydb"];
            $temp[$val] = $val;
        }
        $counts = [];
        foreach ($temp as $table) {
            $entries = DB::execute("SELECT COUNT(*) FROM {$table}");
            $counts[] = [
                'name' => $aliasTables[$table] ?? $table,
                'count' => $entries[0][0],
            ];
        }
        return $counts;
    }

    /*
     * Shows the dashboard page.
     * uses usort's merge sort for a complexity of O(n*log(n)).
     * which is a lot better than bubble sort's complexity of O(n^2). See https://nl.wikipedia.org/wiki/Complexiteitsgraad for more info.
     * */
    public function showDashboard(Request $req, Response $res)
    {
        $counts = $this->getallTablesCount([
            'users' => 'gebruikers',
            'careforschemas' => 'behandelplannen',
            'comments' => 'opmerkingen',
            'day2dayinformation' => 'dagelijkse informatie',
            'events' => 'gebeurtenissen',
            'profiles' => 'profiellen',
            'profiles_doctors' => 'behandelaars',
            'profiles_employees' => 'gasthuis medewerkers',
            'profiles_kids' => 'kinderen',
            'profiles_parents_caretakers' => 'ouders/verzorgers',
            'roles' => 'rollen',
        ]);
        usort($counts, function ($a, $b) {
            return $a['count'] < $b['count'];
        });
        function linkMaker($link, $name)
        {
            return compact('link', 'name');
        }

        $links = [
            linkMaker(Routes::routes['cms_day2dayInformation'], 'dagelijkse informatie'),
            linkMaker(Routes::routes['cms_events'], 'gebeurtenissen'),
            linkMaker(Routes::routes['cms_users'], 'gebruikers'),
            linkMaker(Routes::routes['cms_roles'], 'rollen'),
        ];
        return View::render('pages.CmsDashboard', compact('counts', 'links'));
    }
}