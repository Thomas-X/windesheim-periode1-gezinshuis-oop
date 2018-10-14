<?php
extract([
    'title' => 'Kind informatie',
    'titleKey' => 'nickname',
    'baseUri' => \Qui\lib\Routes::routes['cms_kids'],
    'newItemName' => 'ouders/verzorger'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>