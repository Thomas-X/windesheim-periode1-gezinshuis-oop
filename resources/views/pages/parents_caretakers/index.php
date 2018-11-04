<?php
extract([
    'title' => 'Ouders/verzorgers informatie',
    'titleKey' => 'nickname',
    'baseUri' => \Qui\lib\Routes::$routes['cms_parents_caretaker'],
    'newItemName' => 'ouders/verzorger'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>