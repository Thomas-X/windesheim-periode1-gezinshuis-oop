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
    private const DIRECTORY = 'pictures/';

    private const ALLOWED_EXTENSIONS = [
        'jpeg',
        'jpg',
        'png'
    ];

    public static function createPictureCollection(array $pictures)
    {
        if (!isset($pictures['name']) || !isset($pictures['tmp_name']))
            return false;

        $pictureCount = count($pictures['name']);
        if ($pictureCount > 0) {

            $folder = Authentication::generateRandomString() . '_pictures';
            $uploadDir = PictureCollection::DIRECTORY . "/" . $folder;

            $didMakeDir = mkdir($uploadDir);
            if (!$didMakeDir)
                return false;

            $collectionId = (int)DB::insertEntry('collections', ['collection' => $folder]);
            for ($i = 0; $i < $pictureCount; $i++) {
                //Get file extension to check if it is valid.
                $pictureName = strtolower($pictures['name'][$i]);
                $pictureExtension = pathinfo($pictureName, PATHINFO_EXTENSION);

                if (in_array($pictureExtension, PictureCollection::ALLOWED_EXTENSIONS)) {
                    $pictureName = PictureCollection::createFileName($uploadDir, $pictureName);
                    $pictureName = strtolower($pictureName);
                    $fullPicturePath = $uploadDir . '/' . $pictureName;

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

    private static function createFileName(string $uploadDir, string $pictureName)
    {
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
        return $pictureName;
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

                $fullPictureName = "pictures/{$collection}/{$image}";
                $didUnlink = unlink($fullPictureName);
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
        if (isset($collectionId) && $collectionId > 0 &&
            isset($pictureId) && $pictureId > 0 &&
            isset($picture)) {
            //Get the amount of times a collection id is in the collections table.
            $collectionCount = (int)DB::selectCount('collections', 'id', $collectionId)[0][0];
            //Get the amount of times a picture id is in the pictures table.
            $pictureCount = (int)DB::selectCount('pictures', 'id', $pictureId)[0][0];

            $pictureExtension = pathinfo($picture['name'], PATHINFO_EXTENSION);
            if ($collectionCount > 0 && $pictureCount > 0 && in_array($pictureExtension, PictureCollection::ALLOWED_EXTENSIONS)) {
                //Get the folder where the picture is located.
                $collection = DB::selectWhere('collection', 'collections', 'id', $collectionId)[0]['collection'];
                //Get the name of the current picture.
                $oldPictureName = DB::selectWhere('name', 'pictures', 'id', $pictureId)[0]['name'];

                //Rename the current picture temporary.
                $directory = PictureCollection::DIRECTORY . "/" . $collection;
                $fullOldPictureName = "{$directory}/{$oldPictureName}";
                $tmpOldPictureExtension = pathinfo($oldPictureName, PATHINFO_EXTENSION);
                $tmpOldPictureFileName = pathinfo($oldPictureName, PATHINFO_FILENAME);
                $tmpFullOldPictureName = "{$directory}/{$tmpOldPictureFileName}.tmp.{$tmpOldPictureExtension}";
                $didRename = rename($fullOldPictureName, $tmpFullOldPictureName);

                //Upload the new picture. After the new picture is uploaded the old picture is removed
                //and the database is updated.
                //If the upload failed rename the old picture back to it's original name.
                if ($didRename) {
                    $pictureName = PictureCollection::createFileName($directory, $picture['name']);
                    $pictureName = strtolower($pictureName);
                    $fullPicturePath = $directory . '/' . $pictureName;
                    $didUpload = move_uploaded_file($picture['tmp_name'], $fullPicturePath);
                    if ($didUpload)
                    {
                        $didDelete = unlink($tmpFullOldPictureName);
                        if ($didDelete){
                            DB::updateEntry($pictureId, 'pictures', ['name' => $pictureName]);
                            return true;
                        }
                    }
                    else
                        rename($fullOldPictureName, $tmpFullOldPictureName);
                }
            }
        }
        return false;
    }

    public static function getAllPicturesFromCollection(int $collectionId)
    {
        if (isset($collectionId) && $collectionId > 0) {
            //Get the amount of times a collection id is in the collections table.
            $collectionCount = (int)DB::selectCount('collections', 'id', $collectionId)[0][0];

            if ($collectionCount > 0) {
                //Get the folder where the picture is located.
                $collection = DB::selectWhere('collection', 'collections', 'id', $collectionId)[0]['collection'];
                $pictureNames = DB::selectWhere('name', 'pictures', 'collection_id', $collectionId);

                $pictureDirectories = [];

                foreach ($pictureNames as $pictureName) {
                    $pictureDirectories[] = "/pictures/{$collection}/" . $pictureName['name'];
                }

                return $pictureDirectories;
            }
        }
        return false;
    }

    public static function getPictureFromCollection(int $collectionId, int $pictureId)
    {
        if (isset($collectionId) && $collectionId > 0) {
            //Get the amount of times a collection id is in the collections table.
            $collectionCount = (int)DB::selectCount('collections', 'id', $collectionId)[0][0];

            if ($collectionCount > 0) {
                //Get the folder where the picture is located.
                $collection = DB::selectWhere('collection', 'collections', 'id', $collectionId)[0]['collection'];
                $pictureNames = DB::selectMultipleWhere('pictures', ['name'], [
                    'id' => $pictureId,
                    'collection_id' => $collectionId
                ]);

                $pictureName = $pictureNames[0]['name'];
                return "/pictures/{$collection}/$pictureName";
            }
        }
        return false;
    }
}