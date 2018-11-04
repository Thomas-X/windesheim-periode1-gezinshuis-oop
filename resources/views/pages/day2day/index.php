<?php
extract([
    'title' => 'Day 2 day information',
    'titleKey' => 'title',
    'baseUri' => \Qui\lib\Routes::$routes['cms_day2dayInformation'],
    'newItemName' => 'daily information item'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>