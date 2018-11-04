<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Maak een nieuw kind account aan',
    'baseUri' => \Qui\lib\Routes::$routes['cms_kids'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/create.php');
?>
