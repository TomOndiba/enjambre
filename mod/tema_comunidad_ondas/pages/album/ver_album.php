<?php

elgg_load_css('logged');
elgg_load_js("ajax_album");
elgg_load_js("visor_js");
elgg_load_css("visor_css");
$guid = get_input("user");
$user = elgg_get_usuario_byId($guid);

$album = get_input('album');
$parametros = array('album' => $album);
$derecha.= elgg_view('album/ver_album', $parametros);
$body = array('izquierda' => elgg_view('profile/menu', array('user' => $user)), 'derecha' => $derecha);
echo elgg_view_page($user->name, $body, "profile", array('user' => $user));
