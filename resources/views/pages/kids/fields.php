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
        'title' => 'Bijnaam (bijv: Mick F.)',
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
        'html_type' => 'textarea',
        'name' => 'reason',
        'title' => 'voer hier een kort achterliggend verhaal in hoe het kind bij het gasthuis terecht is gekomen',
        'placeholder' => 'Voer hier het verhaal in'
    ]
];