<?php
extract([
    'title' => 'Opmerkingen',
    'titleKey' => 'comment',
    'baseUri' => \Qui\lib\Routes::$routes['cms_comments'],
    'newItemName' => 'opmerking'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>