<?php
/**
 * Página que invoca la vista correspondiente al formulario para el registro de una nueva feria
 */
elgg_load_css("coordinacion");

elgg_load_library('elgg:file');
elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
elgg_push_breadcrumb(elgg_echo('Registrar nueva feria'), 'ferias/registro');

$params = array();
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);

$content .= elgg_view_form('ferias/form_register', $form_vars, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());

