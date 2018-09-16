<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:25
 */

namespace Qui\core\facades;


class View extends Facade
{
    protected function getFacadeAccessor()
    {
        return 'view';
    }
}