<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 20-10-2018
 * Time: 08:10
 */

namespace Qui\app\http\controllers;


use Qui\lib\facades\View;
use Qui\lib\PictureCollection;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\Routes;

class PictureExampleController
{
    public function showUpload(Request $req, Response $res)
    {
        View::Render('pages.Upload');
    }
    public function uploadCollection(Request $req, Response $res)
    {
        PictureCollection::createPictureCollection($req->files['files']);
        $res->redirect(Routes::routes['upload']);
    }

    public function deleteCollection(Request $req, Response $res)
    {
        PictureCollection::deletePictureCollection($req->params['collectionId']);
        $res->redirect(Routes::routes['upload']);
    }
}