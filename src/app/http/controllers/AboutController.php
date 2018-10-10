<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 13:34
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;

class AboutController
{
    public function showAbout(Request $req, Response $res)
    {
        return View::render('pages.About');
    }
}