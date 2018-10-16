<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 13:34
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\View;

class HController
{
    public function showH()
    {
        return View::render('pages.H');
    }
}