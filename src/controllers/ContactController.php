<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/09/18
 * Time: 13:35
 */

namespace Qui\controllers;

use Qui\core\facades\View;

class ContactController
{
    public function showContact()
    {
        return View::render('pages.Contact');
    }
}