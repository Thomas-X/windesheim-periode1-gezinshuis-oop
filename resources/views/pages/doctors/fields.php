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
        'title' => 'Bijnaam (bijv: dr. de Jong)',
        'placeholder' => 'Voer hier je bijnaam in'
    ],
    [
        'html_type' => 'input',
        'type' => 'date',
        'name' => 'dateofbirth',
        'title' => 'Geboortedatum',
        'placeholder' => 'Voer hier je geboortedatum in',
        'create_value' => date('Y-d-m'),
    ],
    [
        'html_type' => 'textarea',
        'name' => 'proficiency',
        'title' => 'Korte beschrijving over de dokter / behandelaar (maximaal 5000 karakters)',
        'placeholder' => 'Voer hier de beschrijving in'
    ]
];