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

/**
 * Class TreatmentDocumentController
 * @package Qui\app\http\controllers
 */
class TreatmentDocumentController
{
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function showUpload(Request $req, Response $res)
    {
        //TODO: Get clients the user is allowed to see.
        $clients= [
            1 => "kid 1",
            2 => "kid 2",
            3 => "kid 3",
            4 => "kid 4",
            5 => "kid 5"
        ];

        return View::render('pages.Treatment', compact('clients'));
    }

    /**
     * @param Request $req
     * @param Response $res
     */
    public function upload(Request $req, Response $res)
    {
        $allowedFileExtensions = [
            'pdf',
            'doc',
            'docx',
            'odt',
            'txt'
        ];

        $uploadDir = getcwd() . '/uploads/';

        //Get client id and uploaded file.
        $clientId = $req->params['client'];
        $file = $req->files['treatmentDocument'];

        //TODO: Return error in the places where it is needed and not yet done.
        //TODO: Show errors in ui.
        //TODO: Show completion in ui.
        if (isset($clientId) && isset($file))
        {
            $fileTmpName = $file['tmp_name'];

            //Get file extension to check if it is valid.
            $fileName = $file['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileExtension, $allowedFileExtensions))
            {
                //Create the path for the uploaded file basted on the client id so it is easy to identify.
                $uploadPath = $uploadDir . $clientId . "." . $fileExtension;

                if (!file_exists($uploadPath))
                {
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                    if ($didUpload)
                        $res->redirect("/upload", 200);
                }
                else
                {
                    $tmpPath = $uploadDir . "tmp." . $fileExtension;
                    $didChange = rename($uploadPath, $tmpPath);

                    if ($didChange)
                    {
                        $didUpload = move_uploaded_file($fileTmpName, $tmpPath);
                        if ($didUpload)
                        {
                            $didDelete = unlink($tmpPath);
                            if ($didDelete)
                                $res->redirect("/upload", 200);
                        }
                        else
                        {
                            $didChange = rename($tmpPath, $uploadPath);
                            if ($didChange)
                                $res->redirect("/upload", 500);
                        }
                    }
                }
            }
            else
                $res->redirect("/upload", 415);

        }
    }
}