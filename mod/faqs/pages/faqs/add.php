<?php

/**
 * Page que reune los datos y redirecciona al formulario que administra la informacion 
 * de las faqs
 * @author DIEGOX_CORTEX
 */

elgg_load_css("coordinacion");

//elgg_load_library('elgg:file');
//elgg_push_breadcrumb(elgg_echo('ferias:menu:title'), 'ferias/');
//elgg_push_breadcrumb(elgg_echo('Registrar nueva feria'), 'ferias/registro');

//$params = array();
//$form_vars = array(
//	'enctype' => 'multipart/form-data',
//	'class' => 'elgg-form-alt',
//);
$id = get_input('id');

$params = array('id' => $id);
$form_params = array('enctype' => 'multipart/form-data');
$content .= elgg_view_form('faqs/add_faq', $form_params, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());

