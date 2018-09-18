<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 19:58
 */

namespace DependencyInjectionContainer\controllers;

use DependencyInjectionContainer\App;

class MyController
{
    public function showHome()
    {
        return App::get('view')
            ->render("<h1>hello world</h1>");
    }
}