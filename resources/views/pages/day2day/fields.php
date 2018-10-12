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
        'name' => 'title',
        'title' => 'Title',
        'placeholder' => 'Insert title'
    ],
    [
        'html_type' => 'textarea',
        'type' => '',
        'name' => 'description',
        'title' => 'Description',
        'placeholder' => 'Type a description..'
    ],
    [
        'html_type' => 'input',
        'type' => 'date',
        'name' => 'date',
        'title' => 'Date',
        'placeholder' => 'Insert date',
        'create_value' => date('Y-d-m')
    ],
];