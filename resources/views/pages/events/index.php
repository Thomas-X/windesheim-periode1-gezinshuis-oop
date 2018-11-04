<?php
extract([
    'title' => 'Events information',
    'titleKey' => 'eventname',
    'baseUri' => \Qui\lib\Routes::$routes['cms_events'],
    'newItemName' => 'event'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>