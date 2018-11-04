<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Maak een nieuw behandelplan aan',
    'baseUri' => \Qui\lib\Routes::$routes['cms_careforschema'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/create.php');
?>
