<?php
/**
 * Created by PhpStorm.
 * User: Romymae
 * Date: 4-10-2018
 * Time: 13:21
 */

namespace Qui\app\http\controllers;


class EditController
{
    public function showEdit()
    {
        return View::render('pages.Edit');
    }
}