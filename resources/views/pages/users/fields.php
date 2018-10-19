<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 23:01
 */

$v = function ($data) {
    $arr = [];
    foreach ($data as $item ){
        $arr[] = [
            'value' => $item['id'],
            'title' => $item['name'],
        ];
    }
    return $arr;
};
$_data = $create_get_includes_data ?? $update_get_includes_data;
$data = $v($_data['roles']);

$fields = [
    [
        'html_type' => 'input',
        'type' => 'text',
        'name' => 'fname',
        'title' => 'voornaam',
        'placeholder' => 'Insert voornaam'
    ],
    [
        'html_type' => 'input',
        'type' => 'text',
        'name' => 'lname',
        'title' => 'achternaam',
        'placeholder' => 'Insert achternaam'
    ],
    [
        'html_type' => 'input',
        'type' => 'email',
        'name' => 'email',
        'title' => 'e-mail',
        'placeholder' => 'Insert e-mail'
    ],
    [
        'html_type' => 'input',
        'type' => 'number',
        'name' => 'mobile',
        'title' => 'mobiel nummer',
        'placeholder' => 'Insert mobiel nummer'
    ],
    [
        'html_type' => 'input',
        'type' => 'password',
        'name' => 'password',
        'title' => 'wachtwoord',
        'placeholder' => 'Insert wachtwoord',
        'not_in_update' => true,
    ],
    [
        'html_type' => 'select',
        'name' => 'roles_id',
        'title' => 'Gebruikers rol (normaal of superadmin)',
        'values' => $data,
    ]
    // TODO select field
//    [
//        'html_type' => 'input',
//        'type' => 'text',
//        'name' => 'eventname',
//        'title' => 'Naam van het event',
//        'placeholder' => 'Insert event name'
//    ],
//    [
//        'html_type' => 'input',
//        'type' => 'date',
//        'name' => 'date_event',
//        'title' => 'Datum',
//        'placeholder' => 'Insert datum',
//        'create_value' => date('Y-d-m')
//    ],
//    [
//        'html_type' => 'input',
//        'type' => 'text',
//        'name' => 'pictures',
//        'title' => 'Foto\'s, met komma gesplitst',
//        'placeholder' => 'Insert picture url'
//    ],
];