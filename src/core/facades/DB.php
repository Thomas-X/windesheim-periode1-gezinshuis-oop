<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:14
 */

namespace Qui\core\facades;

class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'database';
    }
}