<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 21:39
 */
require(__DIR__ . '/fields.php');
extract([
    'title' => 'Update gebruiker',
    'subtitle' => 'Je kan hier <b>niet</b> het wachtwoord veranderen, dat moet de gebruiker zelf doen via wachtwoord vergeten, te vinden bij het login scherm.',
    'baseUri' => \Qui\lib\Routes::routes['cms_users'],
    'fields' => $fields
]);
dd($update_get_includes_data);
require(__DIR__ . '/../templates/cms/update.php');
?>
