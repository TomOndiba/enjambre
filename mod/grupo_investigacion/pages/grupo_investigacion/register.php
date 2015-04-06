<?php
elgg_load_css('logged');
$title = "Registrar Grupo de Investigación";
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
$params = array();
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);
$content = elgg_view_form('grupo_investigacion/register', $form_vars, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());

