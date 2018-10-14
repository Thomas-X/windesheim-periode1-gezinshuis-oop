<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Maak een nieuw medewerker account aan',
    'baseUri' => \Qui\lib\Routes::routes['cms_employees'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/create.php');
?>
