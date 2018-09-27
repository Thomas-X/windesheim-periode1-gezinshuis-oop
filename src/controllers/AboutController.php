<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 13:34
 */

namespace Qui\controllers;

use Qui\core\facades\View;

class AboutController
{
    public function showAbout()
    {
        return View::render('pages.About');
    }
}