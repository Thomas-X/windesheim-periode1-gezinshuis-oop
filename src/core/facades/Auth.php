<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/09/18
 * Time: 19:47
 */

namespace Qui\core\facades;


class Auth extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'auth';
    }
}