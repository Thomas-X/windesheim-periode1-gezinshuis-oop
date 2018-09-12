<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/09/18
 * Time: 14:35
 */

namespace Qui\interfaces;


interface IRouter
{
    public static function serve () : void;
    public static function middleware ($middlewares, $funcToAddRoutes) : void;
}