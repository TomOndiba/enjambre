<?php

$password = get_input('password1');
$user = elgg_get_logged_in_user_entity();

$user->password = md5($password);
$guid = $user->save();


if ($guid) {
    
    system_messages(elgg_echo('La contraseña se cambió correctamente'), 'success');
    forward(elgg_get_site_url().'/profile/'.$user->username);
} else {
    register_error(elgg_echo('No se pudo cambiar la contraseña'), 'error');
    forward(REFERER);
}


