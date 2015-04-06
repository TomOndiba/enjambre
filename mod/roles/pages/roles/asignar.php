<?php
elgg_load_js('mostrarinfo');
$title = "Asignar Roles";
$user = elgg_get_logged_in_user_entity();
admin_gatekeeper();
set_context('admin');

$titulo= elgg_echo('titulo:roles:asignar');
$content = elgg_view_title($title);
$content .= elgg_view('roles/asignar',$params);

$params = array();
$vars = array('content' => $content);
$body = elgg_view_layout('admin', $vars);
echo elgg_view_page($title, $body);

