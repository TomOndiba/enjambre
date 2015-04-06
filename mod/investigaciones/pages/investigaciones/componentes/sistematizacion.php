<?php
elgg_load_css('logged');
elgg_load_library('elgg:file');
$params=array('etapa'=>'1', 'categoria'=>'acompañamiento');
$form_vars = array('enctype' => 'multipart/form-data');
$content .= elgg_view_form('componente/agregar_componente', $form_vars, $params);

$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
