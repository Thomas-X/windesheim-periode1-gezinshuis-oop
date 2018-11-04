<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Create new role',
    'baseUri' => \Qui\lib\Routes::$routes['cms_roles'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/create.php');
?>
