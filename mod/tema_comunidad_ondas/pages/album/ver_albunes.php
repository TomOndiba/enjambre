<?php
elgg_load_css('logged');
$guid= get_input("user");
$user= elgg_get_usuario_byId($guid);
$page= elgg_get_site_url()."profile/{$user->username}";
$parametros=array('guid'=>$user->guid, 'page'=>$page);
$derecha= elgg_view('album/ver_albunes', $parametros);
$body = array('izquierda' => elgg_view('profile/menu', array('user'=>$user)), 'derecha' => $derecha);
echo elgg_view_page($user->name, $body, "profile", array('user' => $user));