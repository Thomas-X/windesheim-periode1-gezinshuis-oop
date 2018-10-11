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
            5 => "kid 5",
            6 => "kid 6"
        ];

        return View::render('pages.TreatmentDocument', compact('clients'));
    }

    /**
     * @param Request $req
     * @param Response $res
     */
    //TODO: Return error in the places where it is needed and not yet done.
    //TODO: Show errors in ui.
    //TODO: Look into refactoring this function.
    public function upload(Request $req, Response $res)
    {
        $allowedFileExtensions = [
            'pdf',
            'doc',
            'docx',
            'odt',
            'txt'
        ];

        $uploadDir = getcwd() . '\\uploads\\';

        //Get client id and uploaded file.
        $clientId = $req->params['client'];
        $file = $req->files['treatmentDocument'];

        if (isset($clientId) && isset($file))
        {
            $fileTmpName = $file['tmp_name'];

            //Get file extension to check if it is valid.
            $fileName = $file['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileExtension, $allowedFileExtensions))
            {
                //Check if file name exists.
                $uploadPath = $uploadDir . $clientId . ".*";
                $files = glob($uploadPath);

                //Replace the star at the end of the upload path with the proper extension
                $uploadPath = rtrim($uploadPath, "*") . $fileExtension;

                if (is_array($files) && count($files) == 0)
                {
                    //If file does not exist on the server upload it.
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                    if ($didUpload)
                        $res->redirect("/upload", 200);
                }
                else
                {
                    //If file does exist temporally rename it, upload the new file and remove the old file if th new file is uploaded.
                    $tmpFileExtension = pathinfo($files[0], PATHINFO_EXTENSION);
                    $tmpUploadPath = $uploadDir . $clientId . "." . $tmpFileExtension;
                    $tmpPath = $uploadDir . "tmp." . $fileExtension;
                    $didChange = rename($tmpUploadPath, $tmpPath);

                    if ($didChange)
                    {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                        if ($didUpload)
                        {
                            $didDelete = unlink($tmpPath);
                            if ($didDelete)
                                $res->redirect("/upload", 200);
                        }
                    }
                }
            }
            $res->redirect("/upload", 500);
        }
    }
}