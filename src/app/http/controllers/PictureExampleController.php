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
    public function showUpload(Request $req, Response $res, array $data = null)
    {
        if ($data !== null)
            View::Render('pages.Upload', $data);
        else
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

    public function deletePicture(Request $req, Response $res)
    {
        PictureCollection::deletePicture($req->params['collectionId'], $req->params['pictureId']);
        $res->redirect(Routes::routes['upload']);
    }

    public function updatePicture(Request $req, Response $res)
    {
        PictureCollection::updatePictureCollection($req->params['collectionId'], $req->params['pictureId'], $req->files['file']);
        $res->redirect(Routes::routes['upload']);
    }

    public function getAllPicturesFromCollection(Request $req, Response $res)
    {
        $pictureDirectories = PictureCollection::getAllPicturesFromCollection($req->params['collectionId']);
        self::showUpload($req, $res, ['pictureDirectories' => $pictureDirectories]);
    }

    public function getPictureFromCollection(Request $req, Response $res)
    {
        $pictureDirectory = PictureCollection::getPictureFromCollection($req->params['collectionId'], $req->params['pictureId']);
        self::showUpload($req, $res, compact($pictureDirectory));
    }
}