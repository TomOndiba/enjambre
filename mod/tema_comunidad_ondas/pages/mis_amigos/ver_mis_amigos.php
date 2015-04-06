<?php


elgg_load_css('logged');
$guid = get_input("user");
$user = elgg_get_usuario_byId($guid);

$derecha.= elgg_view('profile/ver_mis_amigos', array('user'=>$user));
$body = array('izquierda' => elgg_view('profile/menu', array('user' => $user)), 'derecha' => $derecha);
echo elgg_view_page($user->name, $body, "profile", array('user' => $user));