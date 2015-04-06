<?php
elgg_load_css('logged');
$guid= get_input("user");
$user= elgg_get_usuario_byId($guid);
$page= elgg_get_site_url()."profile/{$user->username}";
$parametros=array('guid'=>$guid);
$form_params=array('enctype' => 'multipart/form-data');
$derecha= elgg_view_form('album/crear_album', $form_params ,$parametros);
$body = array('izquierda' => elgg_view('profile/menu', array('user'=>$user)), 'derecha' => $derecha);
echo elgg_view_page($user->name, $body, "profile", array('user' => $user));