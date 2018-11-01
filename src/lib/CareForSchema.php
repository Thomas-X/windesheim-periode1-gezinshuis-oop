<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1-11-2018
 * Time: 13:00
 */

namespace Qui\lib;

use Qui\lib\facades\NotifierParser;

class CareForSchema
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
     * Upload the care for schema associated with the user.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     * @param int $id The id of the user associated with the care for schema
     */
    public static function uploadCareForSchemas(Request $req, Response $res, int $id)
    {
        //Check if the parameters are valid.
        if (isset($req->files['careforschema']))
        {
            //Get client id, name of the file and the uploaded file.
            $file = $req->files['careforschema'];

            $fileTmpName = $file['tmp_name'];

            //Get file extension to check if it is valid.
            $fileName = $file['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileExtension, self::$allowedFileExtensions))
            {
                //Check if file name exists.
                $uploadPath = CareForSchema::DIRECTORY . $id . '.*';
                $files = glob($uploadPath);

                //Replace the star at the end of the upload path with the proper extension
                $uploadPath = rtrim($uploadPath, '*') . $fileExtension;

                if (is_array($files) && count($files) == 0)
                {
                    //If file does not exist on the server upload it.
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                }
                else
                {
                    //If file does exist temporally rename it, upload the new file and remove the old file if th new file is uploaded.
                    $tmpFileExtension = pathinfo($files[0], PATHINFO_EXTENSION);
                    $tmpUploadPath = CareForSchema::DIRECTORY . $id . '.' . $tmpFileExtension;
                    $tmpPath = CareForSchema::DIRECTORY . 'tmp.' . $fileExtension;
                    $didChange = rename($tmpUploadPath, $tmpPath);

                    if ($didChange)
                    {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                        if ($didUpload)
                        {
                            unlink($tmpPath);
                        }
                    }
                }
            }
        }
    }

    /**
     * Delete the care for schema associated with the user.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     */
    public static function deleteCareForSchemas(Request $req, Response $res)
    {
        //Check if the parameters are valid.
        if (isset($req->params['id']) && trim($req->params['id']) !== "" && is_numeric($req->params['id'])){
            $clientId = $req->params['id'];
            $files = glob(CareForSchema::DIRECTORY . $clientId . '.*');
            array_map('unlink', $files);
        }
    }

    /**
     * Download the care for schema associated with the user.
     * @param Request $req An object containing the information for the request
     * @param Response $res An object for the response.
     */
    public static function downloadCareForSchemas(Request $req, Response $res)
    {
        //Check if the parameters are valid.
        if (isset($req->params['id']) && trim($req->params['id']) !== "" && is_numeric($req->params['id'])){
            $clientId = trim($req->params['id']);
            $files = glob( CareForSchema::DIRECTORY . $clientId . '.*');
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
            }
        }
    }
}