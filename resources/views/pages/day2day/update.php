<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Update daily information item',
    'baseUri' => \Qui\lib\Routes::routes['cms_day2dayInformation'],
    'fields' => $fields
]);
require(__DIR__ . '/../templates/cms/update.php');
?>
