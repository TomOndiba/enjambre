<?php
/**
 * Página que invoca la vista correspondiente al formulario para el registro de una nueva convocatoria
 */
elgg_load_css("coordinacion");

elgg_push_breadcrumb(elgg_echo('Convocatorias'), 'convocatorias/');
elgg_push_breadcrumb(elgg_echo('Registrar nueva convocatoria'), 'convocatorias/registro');

$params = array();
$content .= elgg_view_form('convocatorias/form_register', NULL, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());


