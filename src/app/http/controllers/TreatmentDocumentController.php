<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 2-10-2018
 * Time: 19:36
 */

namespace Qui\app\http\controllers;

use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\facades\View;

class TreatmentDocumentController
{
    public function showUpload(Request $req, Response $res)
    {
        $clients= [
            1 => "kid 1",
            2 => "kid 2",
            3 => "kid 3"
        ];

        return View::render('pages.Treatment', compact('clients'));
    }

    public function upload(Request $req, Response $res)
    {
    }
}