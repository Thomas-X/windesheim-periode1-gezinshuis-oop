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
        'title' => 'Bijnaam (bijv: dhr Zwarts)',
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
        'type' => 'text',
        'name' => 'picture',
        'title' => 'voer hier een directe link naar een foto van de ouder/verzorger in',
        'placeholder' => 'Voer hier de link in'
    ]
];