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
        'name' => 'name',
        'title' => 'een korte naam van het behandelplan (bijv behandelplan Tuan N.)',
        'placeholder' => 'Voer hier een naam in'
    ],
    [
        'html_type' => 'input',
        'type' => 'date',
        'name' => 'date_start',
        'title' => 'Start van het behandelplan',
        'placeholder' => 'Voer hier de startdatum in',
        'create_value' => date('Y-m-d')
    ],
    [
        'html_type' => 'input',
        'type' => 'date',
        'name' => 'date_review',
        'title' => 'de datum dat het behandelplan beoordeelt wordt.',
        'placeholder' => 'Voer hier de beoordeeldatum in',
        'create_value' => date('Y-m-d')
    ],
    [
        'html_type' => 'checkbox',
        'value' => '1',
        'checked' => true,
        'name' => 'parent_has_permission',
        'title' => 'Ouder mag behandelplan inzien',
    ],
    [
        'html_type' => 'checkbox',
        'value' => '1',
        'checked' => false,
        'name' => 'kid_has_permission',
        'title' => 'Kind mag behandelplan inzien',
    ],
];