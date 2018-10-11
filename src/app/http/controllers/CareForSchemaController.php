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
use Qui\lib\facades\NotifierParser;

/**
 * Class CareForSchemaController
 * @package Qui\app\http\controllers
 */
class CareForSchemaController
{
    private static $allowedFileExtensions = [
                                                'pdf',
                                                'doc',
                                                'docx',
                                                'odt',
                                                'txt'
                                            ];

    private static $mimeTypes = [
                                    'pdf' => 'application/pdf',
                                    'doc' => 'application/msword',
                                    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                    'odt' => 'application/vnd.oasis.opendocument.text',
                                    'txt' => 'text/plain'
                                ];


    /**
     * Show the clients the user is allowed to see.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     * @return mixed The view of all the clients will be returned.
     */
    public function showCareForSchemas(Request $req, Response $res)
    {
        //TODO: Get clients the user is allowed to see.
        $clients= [
            1 => 'kid 1',
            2 => 'kid 2',
            3 => 'kid 3',
            4 => 'kid 4',
            5 => 'kid 5',
            6 => 'kid 6'
        ];

        return View::render('pages.CareForSchema', compact('clients'));
    }

    public function careForSchemasFile(Request $req, Response $res)
    {
        if (array_key_exists('upload', $req->params))
            $this->uploadCareForSchemas($req, $res);
        else
            $this->downloadCareForSchemas($req, $res);
    }

    /**
     * Upload the care for schema.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     * @return mixed The view of all the clients will be returned.
     */
    public function uploadCareForSchemas(Request $req, Response $res)
    {

        $uploadDir = 'uploads\\';

        //Get client id and uploaded file.
        $clientId = trim($req->params['clientId']);
        $file = $req->files['treatmentDocument'];

        //Check if the parameters are valid.
        if (isset($clientId) && $clientId !== '' && is_numeric($clientId) && isset($file))
        {
            $fileTmpName = $file['tmp_name'];

            //Get file extension to check if it is valid.
            $fileName = $file['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileExtension, self::$allowedFileExtensions))
            {
                //Check if file name exists.
                $uploadPath = $uploadDir . $clientId . '.*';
                $files = glob($uploadPath);

                //Replace the star at the end of the upload path with the proper extension
                $uploadPath = rtrim($uploadPath, '*') . $fileExtension;

                if (is_array($files) && count($files) == 0)
                {
                    //If file does not exist on the server upload it.
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                    if ($didUpload){
                        //Notify the user the document was uploaded.
                        NotifierParser::init()
                            ->newNotification()
                            ->success()
                            ->message('Behandel document is geüpload.');
                        return $this->showCareForSchemas($req, $res);
                    }

                    NotifierParser::init()
                        ->newNotification()
                        ->error()
                        ->message('Er is iets fout gegaan tijdens het uploaden van het behandeldocument.');
                    return $this->showCareForSchemas($req, $res);
                }
                else
                {
                    //If file does exist temporally rename it, upload the new file and remove the old file if th new file is uploaded.
                    $tmpFileExtension = pathinfo($files[0], PATHINFO_EXTENSION);
                    $tmpUploadPath = $uploadDir . $clientId . '.' . $tmpFileExtension;
                    $tmpPath = $uploadDir . 'tmp.' . $fileExtension;
                    $didChange = rename($tmpUploadPath, $tmpPath);

                    if ($didChange)
                    {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                        if ($didUpload)
                        {
                            $didDelete = unlink($tmpPath);
                            if ($didDelete){
                                NotifierParser::init()
                                    ->newNotification()
                                    ->success()
                                    ->message('Behandel document is geüpload.');
                                return $this->showCareForSchemas($req, $res);
                            }
                        }
                    }

                    NotifierParser::init()
                        ->newNotification()
                        ->error()
                        ->message('Er is iets fout gegaan tijdens het overschrijven van het behandeldocument.');
                    return $this->showCareForSchemas($req, $res);
                }
            }
            //Notify the user not a valid document was given.
            NotifierParser::init()
                ->newNotification()
                ->warning()
                ->message('Fout type bestand. Het behandel document moet een .pdf, .doc, .docx, .odt of .txt bestand zijn.');
            return $this->showCareForSchemas($req, $res);
        }
        elseif (!isset($clientId) || $clientId === '' || !is_numeric($clientId) ){
            //Notify the user not a valid client was given.
            NotifierParser::init()
                ->newNotification()
                ->warning()
                ->message('Ongeldige cliënt geselecteerd.');
            return $this->showCareForSchemas($req, $res);
        }

        //Notify the user no document was given.
        NotifierParser::init()
            ->newNotification()
            ->warning()
            ->message('Geen behandel document geupload.');
        return $this->showCareForSchemas($req, $res);
    }

    /**
     * Download the care for schema.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     * @return mixed The view of all the clients will be returned.
     */
    public function downloadCareForSchemas(Request $req, Response $res)
    {
        $clientId = trim($req->params['clientId']);

        //Check if the parameters are valid.
        if (isset($clientId) && $clientId !== "" && is_numeric($clientId)){
            $files = glob( 'uploads\\' . $req->params['clientId'] . '.*');
            if (count($files) > 0) {
                $file = $files[0];
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $mimeType = self::$mimeTypes[$extension];
                //TODO Show notification when download is finished.
                header('Content-Description: File Transfer');
                header('Content-Type: ' . $mimeType);
                header('Content-Disposition: attachment; filename="' . $clientId . '.' . $extension . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));

                NotifierParser::init()
                    ->newNotification()
                    ->success()
                    ->message('Behandel document is gedownload.');
                return $this->showCareForSchemas($req, $res);
            }
            NotifierParser::init()
                ->newNotification()
                ->warning()
                ->message('Er is geen behandel document voor de cliënt.');
            return $this->showCareForSchemas($req, $res);
        }
        NotifierParser::init()
            ->newNotification()
            ->warning()
            ->message('Ongeldige cliënt geselecteerd.');
        return $this->showCareForSchemas($req, $res);
    }
}