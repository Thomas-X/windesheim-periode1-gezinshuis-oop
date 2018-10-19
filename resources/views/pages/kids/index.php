<?php
extract([
    'title' => 'Kind informatie',
    'titleKey' => 'nickname',
    'baseUri' => \Qui\lib\Routes::routes['cms_kids'],
    'newItemName' => 'kinderen'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>