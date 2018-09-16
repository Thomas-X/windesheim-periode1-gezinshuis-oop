<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 21:53
 */

namespace Qui\core\facades;

/*
 * A router Facade, we need to give the key for the instance that's in our app. so 'router' in this instance, or 'db' or whatever is cool
 * */
class Router extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}