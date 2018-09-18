<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 20:14
 */

namespace DependencyInjectionContainer\controllers;


use DependencyInjectionContainer\App;

class NotFound
{
    public function showNotFound()
    {
        return App::get('view')
            ->render("<h1>Not found</h1>");

    }
}