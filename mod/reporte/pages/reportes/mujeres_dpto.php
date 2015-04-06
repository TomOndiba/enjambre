<?php

/**
 * Page que redirecciona a la vista donde se genera el reporte de mujeres por departamento
 * @author DIEGOX_CORTEX
 */
//elgg_load_css("coordinacion");
elgg_load_css('logged');


$params = array();
//$content.= elgg_view('reportes/mujeres_dpto', $params);
//$body = array('content' => $content);
//echo elgg_view_page($title, $body, "coordinacion_one_column", array());
$content = elgg_view('reportes/mujeres_dpto',null, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
