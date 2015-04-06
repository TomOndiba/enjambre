<?php


$title = "Crear institucion";
$user = elgg_get_logged_in_user_entity();
$guid= get_input('id');

$instituciones= elgg_get_instituciones();
//$institucion= elgg_get_entities_from_metadata($options);
$params = array('instituciones'=>$instituciones);
$content = elgg_view('instituciones/list', $params);
$vars = array('content' => $content);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);
