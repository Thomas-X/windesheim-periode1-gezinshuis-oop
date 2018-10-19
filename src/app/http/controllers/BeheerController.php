<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 13:34
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\View;

class BeheerController
{
    public function showBeheer()
    {
        return View::render('pages.Beheer');
    }
}