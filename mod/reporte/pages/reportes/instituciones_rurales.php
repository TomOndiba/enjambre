<?php

/**
 * Page que redirecciona a la vista donde se genera el reporte de instituciones rurales
 * @author erika_parra
 */
//elgg_load_css("coordinacion");
elgg_load_css('logged');


$params = array();

$content = elgg_view('reportes/instituciones_rurales',null, $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());
