<?php
/**
 * Created by PhpStorm.
 * User: Romymae
 * Date: 4-10-2018
 * Time: 13:22
 */

namespace Qui\app\http\controllers;


class DeleteController
{
    public function showDelete()
    {
        return View::render('pages.Delete');
    }
}