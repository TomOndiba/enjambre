<?php

/**
 * Page que reune la infirmacion necesaria para llevar a la vista donde el asesor 
 * administra sus lineas tematicas...
 * @author DIEGOX_CORTEX
 */

$asesor = elgg_get_logged_in_user_entity();
elgg_load_css("coordinacion");
$content = elgg_view('asesores/ver_cronograma_linea', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "asesores", array());

