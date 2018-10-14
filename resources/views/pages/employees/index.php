<?php
extract([
    'title' => 'Medewerker informatie',
    'titleKey' => 'nickname',
    'baseUri' => \Qui\lib\Routes::routes['cms_employees'],
    'newItemName' => 'medewerker account'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>