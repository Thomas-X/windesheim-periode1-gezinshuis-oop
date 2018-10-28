<?php
extract([
    'title' => 'Behandelplan informatie',
    'titleKey' => 'name',
    'baseUri' => \Qui\lib\Routes::routes['cms_careforschema'],
    'newItemName' => 'behandelplan'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>