<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Pas dokter / behandelaar aan',
    'baseUri' => \Qui\lib\Routes::$routes['cms_doctors'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/update.php');
?>
