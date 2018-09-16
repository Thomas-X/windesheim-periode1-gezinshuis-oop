<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:17
 */

namespace Qui\core\facades;

class DB_PDO extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pdo';
    }
}