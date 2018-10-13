<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/10/18
 * Time: 00:39
 */

namespace Qui\lib;

use Qui\lib\facades\Authentication;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\Routes;
use Qui\lib\facades\Router;
use Qui\lib\facades\DB;

/*
 * TODO: Protect routes and only show certain data with restrictions.
 * TODO: Validate Requests received in TableController.php
 * CMS checklist
 * [X]     'cms' => '/cms',
   [X]     'cms_day2dayInformation' => '/cms/day2dayinformation',
   [WIP]     'cms_roles' => '/cms/roles',
   []     'cms_comments' => '/cms/comments',
   [X]     'cms_events' => '/cms/events',
   []     'cms_doctors' => '/cms/doctors',
   []     'cms_parents' => '/cms/parent',
   []     'cms_kids' => '/cms/kids',
   []     'cms_manage_kid' => '/cms/manage/kid', // manage child 'behandeldocument' view rights
   []     'cms_manage_parent' => '/cms/manage/parent', // manage parent 'behandeldocument' view rights
   []     'cms_manage_doctor' => '/cms/manage/doctor', // manage with children are linked to doctor
   [X]     'cms_users' => '/cms/users',
 *
 *
 *
 * */

class CMS_BUILDER
{
    public static function init()
    {
        $req = new Request();
        $res = new Response();
        static::day2dayinformation($req, $res);
        static::events($req, $res);
        static::users($req, $res);
        static::roles($req,$res);
    }

    private static function makeGenerator($req, $res, $opts)
    {
        $id = $req->params['id'] ?? null;
        $route = $opts['route'];
        $table = $opts['table'];
        $pageFolderName = $opts['pageFolderName'];
        $create_post_includes = $opts['create_post_includes'];
        $create_post_includes_data = $opts['create_post_includes_data'];
        return [
            'selectAll' => [
                'route' => $route,
                'data' => [
                    'table' => $table,
                    'selectAll' => null,
                    'page' => 'pages.' . $pageFolderName . '.index'
                ]
            ],
            'create_get' => [
                'route' => $route,
                'data' => [
                    'page' => 'pages.' . $pageFolderName . '.create',
                    'create_get_includes_data' => $opts['create_get_includes_data'],
                ]
            ],
            'update_get' => [
                'route' => $route,
                'data' => [
                    'page' => 'pages.' . $pageFolderName . '.update',
                    'key' => 'id',
                    'identifier' => $id,
                    'table' => $table,
                    'update_get_includes_data' => $opts['update_get_includes_data']
                ]
            ],
            'create_post' => [
                'route' => $route,
                'data' => [
                    'table' => $table,
                    'redirect' => $route,
                    'includes' => $create_post_includes,
                    'includes_data' => $create_post_includes_data
                ]
            ],
            'update_post' => [
                'route' => $route,
                'data' => [
                    'table' => $table,
                    'id' => $id,
                    'redirect' => $route
                ]
            ],
            'delete_post' => [
                'route' => $route,
                'data' => [
                    'table' => $table,
                    'identifier' => $id,
                    'key' => 'id',
                    'redirect' => $route
                ]
            ]
        ];
    }

    private static function events(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_events'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'events',
            'pageFolderName' => 'events',
            'create_post_includes' => [
                'date_event',
                'eventname',
                'pictures',
            ],
            'create_post_includes_data' => [

            ],
        ]));
    }

    private static function users(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_users'];
        $roles = DB::selectAll('roles');
        if (isset($id)) {
            $usrRoleId = DB::selectWhere('roles_id', 'users', 'id', $id)[0]['roles_id'];
            $index = 0;
            foreach ($roles as $idx => $role) {
                if ($role['id'] == $usrRoleId) {
                    $index = $idx;
                    break;
                }
            }
            $tmp = $roles[$index];
            unset($roles[$index]);
            array_push($roles, $tmp);
            $roles = array_reverse($roles);
        }

        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'users',
            'pageFolderName' => 'users',
            'create_post_includes' => [
                'fname',
                'lname',
                'email',
                'mobile',
                'roles_id',
                'password',
            ],
            'create_post_includes_data' => [
                'password' => isset($req->params['password'])
                    ? Authentication::generateHash($req->params['password'])
                    : null,
                'rememberMeToken' => Authentication::generateRandomHash(),
                'forgotPasswordToken' => '',
            ],
            'create_get_includes_data' => [
                'roles' => DB::selectAll('roles')
            ],
            'update_get_includes_data' => [
                'roles' => $roles,
            ]
        ]));
    }

    private static function day2dayinformation(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_day2dayInformation'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'day2dayinformation',
            'pageFolderName' => 'day2day',
            'create_post_includes' => [
                'date',
                'description',
                'title',
                'profiles_employees_id'
            ],
            'create_post_includes_data' => [
                // Since the only user coming here should be logged as an employee
                // TODO remove mock (when profiles are implemented) see $employees_id
                // $employees_id = \Qui\lib\facades\Authentication::verify(true)['id'];
                 'profiles_employees_id' => 1,
            ],
        ]));
    }

    private static function roles(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_roles'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'roles',
            'pageFolderName' => 'roles',
            'create_post_includes' => [
                'name',
                'description',
            ],
        ]));
    }

    private static function make(Request $req, Response $res, $opts)
    {
        if (array_key_exists('type', $req->params)) {
            switch ($req->params['type']) {
                case 'create_get':
                    Router::get($opts['create_get']['route'], 'TableController@create_get', $opts['create_get']['data']);
                    break;
                case 'update_get':
                    Router::get($opts['update_get']['route'], 'TableController@update_get', $opts['update_get']['data']);
                    break;
                case 'create_post':
                    Router::post($opts['create_post']['route'], 'TableController@create_post', $opts['create_post']['data']);
                    break;
                case 'update_post':
                    Router::post($opts['update_post']['route'], 'TableController@update_post', $opts['update_post']['data']);
                    break;
                case 'delete_post':
                    Router::post($opts['delete_post']['route'], 'TableController@delete_post', $opts['delete_post']['data']);
                    break;
            }
        } else {
            Router::get($opts['selectAll']['route'], 'TableController@index', $opts['selectAll']['data']);
        }
    }
}