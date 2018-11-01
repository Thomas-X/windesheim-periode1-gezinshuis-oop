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
use Qui\lib\Routes;

/**
 * Class CareForSchemaController
 * @package Qui\app\http\controllers
 */
class CareForSchemaController
{
    public const DIRECTORY = 'uploads/';

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

        if (isset($req->params['download_status']) && $req->params['download_status'] == 'success'){
            NotifierParser::init()
                ->newNotification()
                ->success()
                ->message('Behandel document is gedownload.');
        }
        return View::render('pages.CareForSchema', compact('clients'));
    }

    public function careForSchemasFile(Request $req, Response $res)
    {
        if (isset($req->params['type'])){
            if ($req->params['type'] === 'update_post' || $req->params['type'] === 'create_post')
                $this->uploadCareForSchemas($req, $res);
            elseif ($req->params['type'] === 'delete_post')
                $this->deleteCareForSchemas($req, $res);
            elseif ($req->params['type'] === 'download_post')
                $this->downloadCareForSchemas($req, $res);
        }
    }

    /**
     * Upload the care for schema.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     * @return mixed The view of all the clients will be returned.
     */
    public function uploadCareForSchemas(Request $req, Response $res)
    {
        //Check if the parameters are valid.
        if (isset($req->params['id']) && trim($req->params['id']) !== '' && is_numeric($req->params['id'])
            && isset($req->files['careforschema']))
        {
            //Get client id, name of the file and the uploaded file.
            $clientId = trim($req->params['id']);
            $file = $req->files['careforschema'];

            $fileTmpName = $file['tmp_name'];

            //Get file extension to check if it is valid.
            $fileName = $file['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileExtension, self::$allowedFileExtensions))
            {
                //Check if file name exists.
                $uploadPath = CareForSchemaController::DIRECTORY . $clientId . '.*';
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
                    $tmpUploadPath = CareForSchemaController::DIRECTORY . $clientId . '.' . $tmpFileExtension;
                    $tmpPath = CareForSchemaController::DIRECTORY . 'tmp.' . $fileExtension;
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

    public function deleteCareForSchemas(Request $req, Response $res)
    {
        //Check if the parameters are valid.
        if (isset($req->params['id']) && trim($req->params['id']) !== "" && is_numeric($req->params['id'])){
            $clientId = $req->params['id'];
            $files = glob(CareForSchemaController::DIRECTORY . $clientId . '.*');
            $succeed = array_map('unlink', $files);
            if (in_array(false, $succeed)){
                //Notify the user that de delete failed.
                NotifierParser::init()
                    ->newNotification()
                    ->warning()
                    ->message('Ongeldige cliënt geselecteerd.');
                return $this->showCareForSchemas($req, $res);
            }
            //Notify the user not a valid client was given.
            NotifierParser::init()
                ->newNotification()
                ->success()
                ->message('Behandelplan verwijderd.');
            return $this->showCareForSchemas($req, $res);
        }
        else{
            //Notify the user not a valid client was given.
            NotifierParser::init()
                ->newNotification()
                ->warning()
                ->message('Ongeldige cliënt geselecteerd.');
            return $this->showCareForSchemas($req, $res);
        }
    }

    /**
     * Download the care for schema.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     * @return mixed The view of all the clients will be returned.
     */
    public function downloadCareForSchemas(Request $req, Response $res)
    {
        //Check if the parameters are valid.
        if (isset($req->params['id']) && trim($req->params['id']) !== "" && is_numeric($req->params['id'])){
            $clientId = trim($req->params['id']);
            $files = glob( CareForSchemaController::DIRECTORY . $clientId . '.*');
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
                readfile($file);

                return $res->redirect(Routes::routes['careForSchemas']);
            }
            NotifierParser::init()
                ->newNotification()
                ->warning()
                ->message('Er is geen behandel document voor de cliënt.');
            return $res->redirect(Routes::routes['careForSchemas']);
        }
        NotifierParser::init()
            ->newNotification()
            ->warning()
            ->message('Ongeldige cliënt geselecteerd.');
        return $res->redirect(Routes::routes['careForSchemas']);
    }
}