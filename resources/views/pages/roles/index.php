<?php
extract([
    'title' => 'Rollen informatie',
    'subtitle' => 'Het is niet aangeraden om dit aan te passen.',
    'titleKey' => 'name',
    'baseUri' => \Qui\lib\Routes::routes['cms_roles'],
    'newItemName' => 'rol'
]);
require(__DIR__ . '/../templates/cms/allEntries.php');
?>