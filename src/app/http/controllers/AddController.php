<?php
/**
 * Created by PhpStorm.
 * User: Romymae
 * Date: 4-10-2018
 * Time: 13:19
 */

namespace Qui\app\http\controllers;


class AddController
{
    public function showAdd()
    {
        return View::render('pages.Add');
    }
}