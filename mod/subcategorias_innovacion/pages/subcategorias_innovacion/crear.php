<?php

/**
 * Page que prepara las variables y redirecciona al formulario "create" para crear subcategorías de innovación
 */
elgg_load_css("coordinacion");

elgg_push_breadcrumb(elgg_echo('subcategorias:menu:title'), 'subcategorias/');
elgg_push_breadcrumb(elgg_echo('Crear subcategoría'), 'subcategorias/registro');
$user = elgg_get_logged_in_user_entity();
$title = "Crear Subcategoría de Innovación";
$params = array('name' => $user->name);
$content = elgg_view_form('subcategorias_innovacion/create', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
