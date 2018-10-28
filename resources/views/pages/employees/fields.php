<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 23:01
 */

$fields = [
    [
        'html_type' => 'input',
        'type' => 'text',
        'name' => 'nickname',
        'title' => 'Bijnaam (bijv: Ricardo M.)',
        'placeholder' => 'Voer hier je bijnaam in'
    ],
    [
        'html_type' => 'input',
        'type' => 'date',
        'name' => 'dateofbirth',
        'title' => 'Geboortedatum',
        'placeholder' => 'Voer hier je geboortedatum in',
        'create_value' => date('Y-m-d')
    ],
    [
        'html_type' => 'input',
        'name' => 'picture',
        'title' => 'voer hier een url van een foto in',
        'placeholder' => 'voer hier de url van een foto in'
    ]
];