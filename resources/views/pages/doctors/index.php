<?php
extract([
    'title' => 'Dokters/Behandelaars informatie',
    'titleKey' => 'nickname',
    'baseUri' => \Qui\lib\Routes::$routes['cms_doctors'],
    'newItemName' => 'dokter / behandelaar'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>