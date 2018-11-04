<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/10/18
 * Time: 23:01
 */

$_data = $create_get_includes_data ?? $update_get_includes_data;
$data = Qui\lib\facades\Util::selectFormatter($_data['roles'], 'id', 'name');

function profileSelector($_data) {
    $str = "";
    foreach ($_data['profile_types'] as $profile) {
        $str .= "<option value='{$profile['value']}'>{$profile['title']}</option>";
    }
    $json = json_encode($_data['profiles']);
    return "<div class='form-group'>
<hr/>
<br/>
<label>kies het type profiel dat bij deze gebruiker hoort. <br/></label>
<select name='profile_type' class='form-control' id='profile_type_selector'>
    {$str}
</select>

<small class='form-text text-muted'>denk aan: is de gebruiker een ouder account of een account van een kind / behandelaar / medewerker?</small>

<div id='profile_container'></div>
<script>
    JSDATA.profiles = {$json}
</script>
<script src='public/js/usercms.js'></script>
</div>";
}


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
        'type' => 'text',
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
    ],
    [
        'custom_html' => profileSelector($_data)
    ]
];