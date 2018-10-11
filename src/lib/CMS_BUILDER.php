<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/10/18
 * Time: 00:39
 */

namespace Qui\lib;

use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\Routes;
use Qui\lib\facades\Router;

// TODO protect routes
class CMS_BUILDER
{
    public static function init()
    {
        $req = new Request();
        $res = new Response();
        static::day2dayinformation($req, $res);
    }

    private static function day2dayinformation(Request $req, Response $res)
    {
        static::make($req, $res, [
            'selectAll' => [
                'route' => Routes::routes['cms_day2dayInformation'],
                'data' => [
                    'table' => 'day2dayinformation',
                    'selectAll' => null,
                    'page' => 'pages.day2day.index'
                ]
            ],
            'create_get' => [
                'route' => Routes::routes['cms_day2dayInformation'],
                'data' => [
                    'page' => 'pages.day2day.create',
                ]
            ],
            'update_get' => [
                'route' => Routes::routes['cms_day2dayInformation'],
                'data' => [
                    'page' => 'pages.day2day.update',
                    'key' => 'id',
                    'identifier' => $req->params['id'],
                    'table' => 'day2dayinformation',
                ]
            ],
            'create_post' => [
                'route' => Routes::routes['cms_day2dayInformation'],
                'data' => [
                    'table' => 'day2dayinformation',
                    'redirect' => Routes::routes['cms_day2dayInformation'],
                    'includes' => ['date',
                        'description',
                        'title',
                        'profiles_employees_id'],
                    'includes_data' => [
                        // Since the only user coming here should be logged as an employee
                        // TODO remove mock
//                            'profiles_employees_id' => \Qui\lib\facades\Authentication::verify(true)['id'],
                        'profiles_employees_id' => 1,
                    ]
                ]
            ],
            'update_post' => [
                'route' => Routes::routes['cms_day2dayInformation'],
                'data' => [
                    'table' => 'day2dayinformation',
                    'id' => $req->params['id'],
                    'redirect' => Routes::routes['cms_day2dayInformation']
                ]
            ],
            'delete_post' => [
                'route' => Routes::routes['cms_day2dayInformation'],
                'data' => [
                    'table' => 'day2dayinformation',
                    'identifier' => $req->params['id'],
                    'key' => 'id',
                    'redirect' => Routes::routes['cms_day2dayInformation']
                ]
            ]
        ]);
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