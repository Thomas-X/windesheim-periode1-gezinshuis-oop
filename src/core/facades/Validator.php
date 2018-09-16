<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:22
 */

namespace Qui\core\facades;


class Validator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'validator';
    }
}