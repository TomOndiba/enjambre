<?php

elgg_load_css("coordinacion");
$params= array();
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);

$content = elgg_view_form('instituciones/register', $form_vars, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());