<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Pas behandelplan aan',
    'subtitle' => 'Om het behandelplan document zelf aan te passen moet je het downloaden, aanpassen en dan uploaden.',
    'baseUri' => \Qui\lib\Routes::routes['cms_careforschema'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/update.php');
?>
