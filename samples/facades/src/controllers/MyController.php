<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 19:58
 */

namespace Facades\controllers;

use Facades\facades\View;

class MyController
{
    public function showHome()
    {
        return View::render("<h1>hello world</h1>");
    }
}