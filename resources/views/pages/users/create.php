<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Create new user',
    'baseUri' => \Qui\lib\Routes::routes['cms_users'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/create.php');
?>
