<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 20:40
 */

namespace Facades\facades;


class View extends Facade
{
    public static function getFacadeAccessor()
    {
        // the key used in the DI container (App)
        return 'view';
    }
}