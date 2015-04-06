<?php

/**
 * Page que redirecciona a la vista donde se genera el reporte de hombres por departamento
 * @author DIEGOX_CORTEX
 */
//elgg_load_css("coordinacion");
elgg_load_css('logged');




$params = array();
//$content.= elgg_view_form('reportes/hombres_dpto', $params);
//$body = array('content' => $content);
//echo elgg_view_page($title, $body, "coordinacion_one_column", array());
//$content = elgg_view_form('reportes/hombres_dpto',NULL, $params);
//$vars = array(
//    'content' => $content,
//);
//$body = elgg_view_layout('one_sidebar', $vars);
//echo elgg_view_page($title, $body);
$content = elgg_view('reportes/ninos_municipio',null, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
