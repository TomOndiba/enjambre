<?php

$title = "Crear Roles";
$user = elgg_get_logged_in_user_entity();
admin_gatekeeper();
set_context('admin');
$content = elgg_view_title($title);
$params = array();
$content .= elgg_view_form('admin/roles/register', $params,false, false,null);
$vars = array('content' => $content);
$body = elgg_view_layout('admin', $vars);
echo elgg_view_page($title, $body);

