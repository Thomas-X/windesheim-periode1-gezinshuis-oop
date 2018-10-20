<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 19-10-2018
 * Time: 19:21
 */

namespace Qui\lib;


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
        if ($pictureCount > 0) {
            $folder = Authentication::generateRandomString() . '_pictures';
            $uploadDir = "pictures/{$folder}";

            $didMakeDir = mkdir($uploadDir);
            if (!$didMakeDir)
                return false;

            $collectionId = (int)DB::insertEntry('collections', ['collection' => $folder]);
            for ($i = 0; $i < $pictureCount; $i++) {
                //Get file extension to check if it is valid.
                $pictureName = strtolower($pictures['name'][$i]);
                $pictureExtension = pathinfo($pictureName, PATHINFO_EXTENSION);

                if (in_array($pictureExtension, $allowedExtensions)) {
                    $fullPicturePath = $uploadDir . '/' . $pictureName;
                    $files = glob($fullPicturePath);

                    $counter = 2;
                    //Rename the picture if it exists.
                    while(isset($files) && is_array($files) && count($files) > 0) {
                        //Separate the picture name and extension.
                        $splitPictureName = explode('.', $pictureName);

                        //If the file already exist with a additional number replace that number with a higher number.
                        if ($counter > 2) {
                            //Replace the number with a new number.
                            $pictureName = substr_replace($splitPictureName[0], "_{$counter}", -2) . '.' . $splitPictureName[1];
                        }
                        else {
                            $pictureName = "{$splitPictureName[0]}_{$counter}.{$splitPictureName[1]}";
                        }

                        $fullPicturePath = $uploadDir . '/' . $pictureName;
                        $files = glob($fullPicturePath);
                        $counter++;
                    }

                    $didUpload = move_uploaded_file($pictures['tmp_name'][$i], $fullPicturePath);

                    if ($didUpload)
                        DB::insertEntry('pictures', [
                            'collection_id' => $collectionId,
                            'name' => $pictureName
                        ]);
                }
            }
            return $folder;
        }
        return false;
    }

    public static function deletePictureCollection(int $collectionId)
    {
        if (isset($collectionId) && $collectionId > 0) {
            //Get the amount of times a collection id is in the collections table.
            $collectionCount = (int)DB::selectCount('collections', 'id', $collectionId)[0][0];

            if ($collectionCount > 0) {
                $collection = DB::selectWhere('collection', 'collections', 'id', $collectionId)[0]['collection'];
                $pictureDirectoryName = "pictures/{$collection}";

                $didRemove = [];
                $failedToRemove = [];
                //Remove the collection folder and all the pictures in it.
                $pictureDirectory = opendir($pictureDirectoryName);
                while (($picture = readdir($pictureDirectory)) !== false) {
                    if (( $picture != '.' ) && ( $picture != '..' )) {
                        $full = $pictureDirectoryName . '/' . $picture;
                        $didUnlink = unlink($full);
                        if (!$didUnlink) {
                            $didRemove[] = $didUnlink;
                            $failedToRemove[] = $picture;
                        }
                    }
                }
                closedir($pictureDirectory);

                //Check if all the pictures where removed.
                //If so the directory will be removed and all the pictures associated with the collection and the collection
                //itself will be removed from the database.
                if (!in_array(false, $didRemove)) {
                    rmdir($pictureDirectoryName);
                    DB::deleteEntry('pictures', 'collection_id', $collectionId);
                    DB::deleteEntry('collections', 'id', $collectionId);
                    return true;
                }
                else {
                    $sql = 'DELETE FROM pictures WHERE ';

                    $failedToRemoveCount = count($failedToRemove) - 1;

                    for ($i = 0; $i <= $failedToRemoveCount; $i++) {
                        if ($i < $failedToRemoveCount)
                            $sql .= "name = ? or ";
                        else
                            $sql .= "name = ? ";
                    }

                    $sql .= "and collection_id = ?";

                    $values = $failedToRemove;
                    $values[] = $collectionId;
                    DB::execute($sql, $values);
                }
            }
        }
        return false;
    }

    public static function deletePicture(int $collectionId, int $pictureId)
    {
        if (isset($collectionId) && $collectionId > 0 &&
            isset($pictureId) && $pictureId > 0) {
            //Get the amount of times a collection id is in the collections table.
            $collectionCount = (int)DB::selectCount('collections', 'id', $collectionId)[0][0];
            //Get the amount of times a picture id is in the pictures table.
            $pictureCount = (int)DB::selectCount('pictures', 'id', $pictureId)[0][0];

            if ($collectionCount > 0 && $pictureCount > 0) {
                $collection = DB::selectWhere('collection', 'collections', 'id', $collectionId)[0]['collection'];

                $image = DB::selectWhere('name', 'pictures', 'id', $pictureId)[0]['name'];

                $fullPictureDirectoryName = "pictures/{$collection}/$image";
                $didUnlink = unlink($fullPictureDirectoryName);
                if ($didUnlink) {
                    DB::deleteEntry('pictures', 'id', $pictureId);
                    return true;
                }
            }
        }
        return false;
    }

    public static function updatePictureCollection(int $collectionId, int $pictureId, array $picture)
    {
    }

    public static function getAllPicturesFromCollection(int $collectionId)
    {
    }

    public static function getPictureFromCollection(int $collectionId, int $pictureId)
    {
    }
}