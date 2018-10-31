<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/10/18
 * Time: 00:39
 */

namespace Qui\lib;

use Qui\lib\facades\Authentication;
use Qui\lib\facades\View;
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
   // NOT TODO cms_day2dayinformation see which comments are related to this daily information (optional)
   [X]     'cms_roles' => '/cms/roles',
   // TODO Hide/Remove this CRUD
   [X]     'cms_comments' => '/cms/comments',
   // NOT TODO when creating / updating a comment you should be able to add it to an event
   // TODO Hide/Remove this CRUD
   [X]     'cms_events' => '/cms/events',
   // TODO pictures implementation is missing
   [X]     'cms_users' => '/cms/users',
   // TODO X
   [X]     'cms_doctors' => '/cms/doctors',
   // TODO link doctor to account / careforschema
   [X]     'cms_parent_caretaker' => '/cms/parent_caretaker',
   // TODO link parent to account / careforschema
   [X]     'cms_kids' => '/cms/kids',
   // TODO link kid to account / careforschema
   [X]     'cms_employees' => '/cms/employees'
   // TODO link employees to account / day2dayinformation
   [X]     'cms_careforschema' => '/cms/careforschema', // add/remove careforschema's
   // TODO manage rights of parent/doctor/kid if it has access
   [X]     'cms_manage_kid' => '/cms/manage/kid', // manage child 'behandeldocument' view rights
   // TODO manage rights if a kid can see his/her 'behandelplan'
   [X]     'cms_manage_parent' => '/cms/manage/parent_caretaker', // manage parent 'behandeldocument' view rights
   // TODO manage rights if a parent/caretaker can see his/her 'behandelplan'
   [X]     'cms_manage_doctor' => '/cms/manage/doctor', // manage which children are linked to doctor
   // TODO manage rights (is unneeded because in cms_careforschema you can add / remove a doctor
 *
 * */

// Final TODO
// TODO DONE Behandelplan crud pagina toevoegen dat je een kind / ouder / behandelaar kan toevoegen
// TODO DONE Pagina waar je een gebruiker kan linken aan behandelaar/medewerker/kind/ouder
class CMS_BUILDER
{
    public const NULL = 'NULL';
    public const UNDEFINED_INPUT_INDEX = null;

    public static function init()
    {
        $req = new Request();
        $res = new Response();
        static::day2dayinformation($req, $res);
        static::events($req, $res);
        static::users($req, $res);
        static::roles($req, $res);
        static::comments($req, $res);
        static::doctors($req, $res);
        static::parent_caretakers($req, $res);
        static::kids($req, $res);
        static::employees($req, $res);
        static::careforschema($req, $res);
    }

    private static function makeGenerator($req, $res, $opts)
    {
        $id = $req->params['id'] ?? null;
        $route = $opts['route'];
        $table = $opts['table'];
        $pageFolderName = $opts['pageFolderName'];
        $create_post_includes = $opts['create_post_includes'] ?? [];
        $create_post_includes_data = $opts['create_post_includes_data'] ?? [];
        $create_get_includes_data = $opts['create_get_includes_data'] ?? [];
        $update_get_includes_data = $opts['update_get_includes_data'] ?? [];
        $update_post_includes = $opts['update_post_includes'] ?? [];
        $update_post_includes_data = $opts['update_post_includes_data'] ?? [];
        $create_post_post_insert = $opts['create_post_post_insert'] ?? [];
        $update_post_post_insert = $opts['update_post_post_insert'] ?? [];
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
                    'create_get_includes_data' => $create_get_includes_data,
                ]
            ],
            'update_get' => [
                'route' => $route,
                'data' => [
                    'page' => 'pages.' . $pageFolderName . '.update',
                    'key' => 'id',
                    'identifier' => $id,
                    'table' => $table,
                    'update_get_includes_data' => $update_get_includes_data,
                ]
            ],
            'create_post' => [
                'route' => $route,
                'data' => [
                    'table' => $table,
                    'redirect' => $route,
                    'includes' => $create_post_includes,
                    'includes_data' => $create_post_includes_data,
                    'post_insert' => $create_post_post_insert
                ]
            ],
            'update_post' => [
                'route' => $route,
                'data' => [
                    'table' => $table,
                    'id' => $id,
                    'redirect' => $route,
                    'includes' => $update_post_includes,
                    'includes_data' => $update_post_includes_data,
                    'post_insert' => $update_post_post_insert
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
            'update_post_includes' => [
                'date_event',
                'eventname',
                'pictures',
            ],
            'create_post_includes_data' => [

            ],
        ]));
    }

    // Moves any index to first index.
    public static function moveIndexToFirstIndex($arr, $valueAccessor, $needle)
    {
        $wArr = $arr;
        $index = 0;
        foreach ($wArr as $idx => $item) {
            if ($item[$valueAccessor] == CMS_BUILDER::NULL || $item[$valueAccessor] == CMS_BUILDER::UNDEFINED_INPUT_INDEX) {
                return $wArr;
            }
            if ($item[$valueAccessor] == $needle) {
                $index = $idx;
                break;
            }
        }
        $tmp = $wArr[$index];
        unset($wArr[$index]);
        array_push($wArr, $tmp);
        return array_reverse($wArr);
    }

    private static function users(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_users'];
        $roles = DB::selectAll('roles');
        if (isset($id)) {
            $usrRoleId = DB::selectWhere('roles_id', 'users', 'id', $id)[0]['roles_id'];
            $roles = CMS_BUILDER::moveIndexToFirstIndex($roles, 'id', $usrRoleId);
        }

        $profile_types = [
            [
                'value' => 'profiles_parents_caretakers',
                'title' => 'ouder/verzorger'
            ],
            [
                'value' => 'profiles_kids',
                'title' => 'kind'
            ],
            [
                'value' => 'profiles_doctors',
                'title' => 'behandelaar'
            ],
            [
                'value' => 'profiles_employees',
                'title' => 'medewerker',
            ],
        ];

        $profiles = [
            'profiles_employees' => DB::selectAll('profiles_employees'),
            'profiles_parents_caretakers' => DB::selectAll('profiles_parents_caretakers'),
            'profiles_kids' => DB::selectAll('profiles_kids'),
            'profiles_doctors' => DB::selectAll('profiles_doctors'),
        ];
        $profiles_update = [];
        if (isset($id)) {
            $profile = (DB::selectWhere('*', 'profiles', 'users_id', $id))[0];
            $val = '';
            $key = '';
            $arr = [
                'profiles_doctors_id',
                'profiles_kids_id',
                'profiles_employees_id',
                'profiles_parents_caretakers_id'
            ];
            foreach ($arr as $key) {
                if ($profile[$key] != null) {
                    $val = $profile[$key];
                    break;
                }
            }
            $key_stripped = substr($key, 0, (strlen($key) - 3));
            $profile_types_update = CMS_BUILDER::moveIndexToFirstIndex($profile_types, 'value', $key_stripped);
            $profiles_update = $profiles;
            unset($profiles_update[$key_stripped]);
            $profiles_update_key_stripped[$key_stripped] = CMS_BUILDER::moveIndexToFirstIndex($profiles[$key_stripped], 'id', $val);
            $profiles_update = array_merge($profiles_update, $profiles_update_key_stripped);
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
            'update_post_includes' => [
                'fname',
                'lname',
                'email',
                'mobile',
                'roles_id',
            ],
            'create_post_includes_data' => [
                'password' => isset($req->params['password'])
                    ? Authentication::generateHash($req->params['password'])
                    : null,
                'rememberMeToken' => Authentication::generateRandomHash(),
                'forgotPasswordToken' => '',
            ],
            'create_get_includes_data' => [
                'roles' => DB::selectAll('roles'),
                'profile_types' => $profile_types,
                'profiles' => $profiles,
            ],
            'create_post_post_insert' => function ($req, $res, $id) {
                if (isset($req->params['profile_type']) && isset($req->params['profile_value'])) {
                    $profile_type = $req->params['profile_type'];
                    $profile_value = $req->params['profile_value'];
                    DB::insertEntry('profiles', [
                        ($profile_type . '_id') => $profile_value,
                        'users_id' => $id,
                    ]);
                }
            },
            'update_post_post_insert' => function ($req, $res) use ($profile_types) {
                if (isset($req->params['profile_type']) && isset($req->params['profile_value'])) {
                    $id = $req->params['id'];
                    $profile_type = $req->params['profile_type'];
                    $profile_value = $req->params['profile_value'];
                    $cb = function($item) {
                        return $item['value'];
                    };
                    $arr = array_map($cb, $profile_types);
                    $arr_db = [];
                    foreach ($arr as $item ) {
                        if ($item != $profile_type) {
                            $arr_db[$item . '_id'] = null;
                        }
                    }
                    $profile = (DB::selectWhere('*', 'profiles', 'users_id', $id))[0];
                    DB::updateEntry($profile['users_id'], 'profiles', array_merge_recursive($arr_db, [
                        ($profile_type . '_id') => $profile_value,
                        'users_id' => $id,
                    ]), 'users_id');
                }
            },
            'update_get_includes_data' => [
                'roles' => $roles,
                'profile_types' => $profile_types_update,
                'profiles' => $profiles_update,
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
            'update_post_includes' => [
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

    private static function comments(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_comments'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'comments',
            'pageFolderName' => 'comments',
            'create_post_includes' => [
                'comment',
            ],
            'update_post_includes' => [
                'comment',
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
            'update_post_includes' => [
                'name',
                'description',
            ],
        ]));
    }

    private static function doctors(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_doctors'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'profiles_doctors',
            'pageFolderName' => 'doctors',
            'create_post_includes' => [
                'nickname',
                'proficiency',
                'dateofbirth',
            ],
            'update_post_includes' => [
                'nickname',
                'proficiency',
                'dateofbirth',
            ],
        ]));
    }

    private static function parent_caretakers(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_parents_caretaker'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'profiles_parents_caretakers',
            'pageFolderName' => 'parents_caretakers',
            'create_post_includes' => [
                'nickname',
                'dateofbirth',
                'picture',
            ],
            'update_post_includes' => [
                'nickname',
                'dateofbirth',
                'picture',
            ],
        ]));
    }

    private static function kids(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_kids'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'profiles_kids',
            'pageFolderName' => 'kids',
            'create_post_includes' => [
                'nickname',
                'dateofbirth',
                'reason',
            ],
            'update_post_includes' => [
                'nickname',
                'dateofbirth',
                'reason',
            ],
        ]));
    }

    public static  function push_arr($arr, $msg)
    {
        array_push($arr, [
            'id' => CMS_BUILDER::UNDEFINED_INPUT_INDEX,
            'nickname' => $msg,
        ]);
        return $arr;
    }


    private static function employees(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;
        $route = Routes::routes['cms_employees'];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'profiles_employees',
            'pageFolderName' => 'employees',
            'create_post_includes' => [
                'nickname',
                'dateofbirth',
                'picture',
            ],
            'update_post_includes' => [
                'nickname',
                'dateofbirth',
                'picture',
            ],
        ]));
    }

    public static function unshift_arr($arr, $msg)
    {
        array_unshift($arr, [
            'id' => CMS_BUILDER::UNDEFINED_INPUT_INDEX,
            'nickname' => $msg
        ]);
        return $arr;
    }

    public static function undefined_index_helper($req, $paramName)
    {
        return empty($req->params[$paramName]) ? null : $req->params[$paramName];
    }


    private static function careforschema(Request $req, Response $res)
    {
        $id = $req->params['id'] ?? null;

        /*
         * PHP's way of doing
         * const doctors, parents_caretakers, kids;
         * */
        $ddoctors = DB::selectAll('profiles_doctors');
        $dparents_caretakers = DB::selectAll('profiles_parents_caretakers');
        $dkids = DB::selectAll('profiles_kids');


        // update
        if (isset($id)) {
            $careforschema = DB::selectWhere('profiles_kids_id, profiles_doctors_id, profiles_parents_caretakers_id', 'careforschemas', 'id', $id)[0];
            function sortMoveIndex($cschema, $cschemaKey, $tableName, $undefinedIndexTitle)
            {
                $arr = DB::selectAll($tableName);
                $_id = $cschema[$cschemaKey];
                if ($_id == CMS_BUILDER::UNDEFINED_INPUT_INDEX) {
                    return CMS_BUILDER::unshift_arr($arr, $undefinedIndexTitle);
                } else {
                    $arr = CMS_BUILDER::moveIndexToFirstIndex($arr, 'id', $_id);
                    $arr = CMS_BUILDER::push_arr($arr, $undefinedIndexTitle);
                    return $arr;
                }
            }

            $doctors = sortMoveIndex($careforschema, 'profiles_doctors_id', 'profiles_doctors', 'Geen dokter..');
            $parents_caretakers = sortMoveIndex($careforschema, 'profiles_parents_caretakers_id', 'profiles_parents_caretakers', 'Geen ouder/verzorger..');
            $kids = sortMoveIndex($careforschema, 'profiles_kids_id', 'profiles_kids', 'Geen kind..');
        } else {
            // create
            $doctors = CMS_BUILDER::unshift_arr($ddoctors, 'Geen dokter..');
            $parents_caretakers = CMS_BUILDER::unshift_arr($dparents_caretakers, 'Geen ouder/verzorger..');
            $kids = CMS_BUILDER::unshift_arr($dkids, 'Geen kind..');
        }

        $route = Routes::routes['cms_careforschema'];
        $keys = [
            'date_start',
            'date_review',
            'extra',
            'parent_has_permission',
            'kid_has_permission',
            'name',
            'profiles_kids_id',
            'profiles_parents_caretakers_id',
            'profiles_doctors_id',
        ];


        $includes_data = [
            'parent_has_permission' => isset($req->params['parent_has_permission']) ? '1' : '0',
            'kid_has_permission' => isset($req->params['kid_has_permission']) ? '1' : '0',
            'profiles_kids_id' => CMS_BUILDER::undefined_index_helper($req, 'profiles_kids_id'),
            'profiles_doctors_id' => CMS_BUILDER::undefined_index_helper($req, 'profiles_doctors_id'),
            'profiles_parents_caretakers_id' => CMS_BUILDER::undefined_index_helper($req, 'profiles_parents_caretakers_id'),
        ];
        static::make($req, $res, static::makeGenerator($req, $res, [
            'route' => $route,
            'table' => 'careforschemas',
            'pageFolderName' => 'careforschemas',
            'create_get_includes_data' => [
                'profiles_doctors' => $doctors,
                'profiles_kids' => $kids,
                'profiles_parents_caretakers' => $parents_caretakers,
            ],
            'update_get_includes_data' => [
                'profiles_doctors' => $doctors,
                'profiles_kids' => $kids,
                'profiles_parents_caretakers' => $parents_caretakers,
            ],
            'create_post_includes' => $keys,
            'update_post_includes' => $keys,
            'create_post_includes_data' => $includes_data,
            'update_post_includes_data' => $includes_data,
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