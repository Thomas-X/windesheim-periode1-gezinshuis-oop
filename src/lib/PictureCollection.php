<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 19-10-2018
 * Time: 19:21
 */

namespace Qui\lib;


use phpDocumentor\Plugin\Core\Descriptor\Validator\Constraints\Functions\DoesArgumentNameMatchParam;
use Qui\lib\facades\Authentication;
use Qui\lib\facades\DB;

class PictureCollection
{
    public static $test;
    public static function createPictureCollection(array $pictures)
    {
        $allowedExtensions = [
            'jpeg',
            'jpg',
            'png'
        ];

        if (!isset($pictures['name']) || !isset($pictures['tmp_name']))
            return false;

        $pictureCount = count($pictures['name']);
        if ($pictureCount > 0)
        {
            $folder = Authentication::generateRandomString() . '_pictures';
            $uploadDir = "pictures/{$folder}";

            $didMakeDir = mkdir($uploadDir);
            if (!$didMakeDir)
                return false;

            $didUploads = [];

            $collectionId = (int)DB::insertEntry('collections', ['collection' => $folder]);
            for ($i = 0; $i < $pictureCount; $i++)
            {
                //Get file extension to check if it is valid.
                $pictureName = strtolower($pictures['name'][$i]);
                var_dump($i);
                $pictureExtension = pathinfo($pictureName, PATHINFO_EXTENSION);

                if (in_array($pictureExtension, $allowedExtensions))
                {
                    $fullPicturePath = $uploadDir . '/' . $pictureName;
                    $files = glob($fullPicturePath);

                    $counter = 2;
                    //Rename the picture if it exists.
                    while(isset($files) && is_array($files) && count($files) > 0)
                    {
                        //Separate the picture name and extension.
                        $splitPictureName = explode('.', $pictureName);

                        //If the file already exist with a additional number replace that number with a higher number.
                        if ($counter > 2)
                        {
                            //Replace the number with a new number.
                            $pictureName = substr_replace($splitPictureName[0], "_{$counter}", -2) . '.' . $splitPictureName[1];
                        }
                        else
                        {
                            $pictureName = "{$splitPictureName[0]}_{$counter}.{$splitPictureName[1]}";
                        }

                        $fullPicturePath = $uploadDir . '/' . $pictureName;
                        $files = glob($fullPicturePath);
                        $counter++;
                    }

                    var_dump($uploadDir);
                    DB::insertEntry('pictures', [
                        'collection_id' => $collectionId,
                        'name' => $pictureName
                    ]);
                    $didUploads[] = move_uploaded_file($pictures['tmp_name'][$i], $fullPicturePath);
                }
            }
            return $folder;
        }
        return false;
    }

    public static function deletePictureCollection(int $collectionId)
    {
    }

    public static function deletePicture(int $collectionId, int $pictureId)
    {
    }

    public static function updatePictureCollection(int $collectionId, int $pictureId, $picture)
    {
    }

    public static function getAllPicturesFromCollection(int $collectionId)
    {
    }

    public static function getPictureFromCollection(int $collectionId, int $pictureId)
    {
    }
}