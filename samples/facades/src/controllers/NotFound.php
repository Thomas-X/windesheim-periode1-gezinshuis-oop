<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 20:14
 */

namespace Facades\controllers;

use Facades\facades\View;

class NotFound
{
    public function showNotFound()
    {
        return View::render("<h1>Not found</h1>");
    }
}