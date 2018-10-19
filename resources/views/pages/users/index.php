<?php
extract([
    'title' => 'Gebruikers informatie',
    'titleKey' => 'fname',
    'secondTitleKey' => 'lname',
    'baseUri' => \Qui\lib\Routes::routes['cms_users'],
    'newItemName' => 'gebruiker'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>