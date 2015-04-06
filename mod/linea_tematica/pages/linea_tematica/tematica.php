<?php

/**
 * Page que prepara las variables y redirecciona a la vista "bienvenido" que dá el mensaje de bienvenida al plugin
 * @author DIEGOX_CORTEX
 */

$user = elgg_get_logged_in_user_entity();
$title = "My first page";
$params = array('name' => $user->name);
$content = elgg_view('forms/linea_tematica/bienvenido', $params);
$vars = array(
    'content' => $content,
);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);

