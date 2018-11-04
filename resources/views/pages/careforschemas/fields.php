<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 23:01
 */

use Qui\lib\Routes;

$_data = $create_get_includes_data ?? $update_get_includes_data;
$dataKid = Qui\lib\facades\Util::selectFormatter($_data['profiles_kids'], 'id', 'nickname');
$dataDoctor = Qui\lib\facades\Util::selectFormatter($_data['profiles_doctors'], 'id', 'nickname');
$dataParentsCareTakers = Qui\lib\facades\Util::selectFormatter($_data['profiles_parents_caretakers'], 'id', 'nickname');

$createKidRoute = Routes::$routes['cms_kids'];
$createParentRoute = Routes::$routes['cms_parents_caretaker'];
$createDoctorRoute = Routes::$routes['cms_doctors'];

$fields = [
    [
        'html_type' => 'input',
        'type' => 'text',
        'name' => 'name',
        'title' => 'Een korte naam van het behandelplan (bijv behandelplan Tuan N.)',
        'placeholder' => 'Voer hier een naam in'
    ],
//    [
//        'html_type' => 'input',
//        'type' => 'file',
//        'name' => 'careforschema',
//        'title' => 'Het behandelplan',
//        'placeholder' => ''
//    ],
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
        'title' => 'De datum dat het behandelplan beoordeelt wordt.',
        'placeholder' => 'Voer hier de beoordeeldatum in',
        'create_value' => date('Y-m-d')
    ],
    [
        'html_type' => 'checkbox',
        'value' => '1',
        'checked' => true,
        'name' => 'parent_has_permission',
        'title' => 'Ouder mag behandelplan inzien'
    ],
    [
        'html_type' => 'checkbox',
        'value' => '1',
        'checked' => false,
        'name' => 'kid_has_permission',
        'title' => 'Kind mag behandelplan inzien'
    ],
    [
        'html_type' => 'select',
        'name' => 'profiles_kids_id',
        'title' => 'Het kind dat met dit behandelplan verbonden is',
        'muteText' => "Als er geen kinderen beschikbaar zijn betekent dat dat er geen kinderen in het systeem staan, ga <a href=\"{$createKidRoute}\">hier naar toe</a> om er een aan te maken",
        'values' => $dataKid,
    ],
    [
        'html_type' => 'select',
        'name' => 'profiles_parents_caretakers_id',
        'title' => 'De ouder(s)/verzorger(s) dat met dit behandelplan verbonden is',
        'muteText' => "Als er geen ouders/verzorgers beschikbaar zijn betekent dat dat er geen kinderen in het systeem staan, ga <a href=\"{$createParentRoute}\">hier naar toe</a> om er een aan te maken",
        'values' => $dataParentsCareTakers,
    ],
    [
        'html_type' => 'select',
        'name' => 'profiles_doctors_id',
        'title' => 'De behandelaar dat met dit behandelplan verbonden is',
        'muteText' => "Als er geen behandelaars beschikbaar zijn betekent dat dat er geen kinderen in het systeem staan, ga <a href=\"{$createDoctorRoute}\">hier naar toe</a> om er een aan te maken",
        'values' => $dataDoctor,
    ],
];