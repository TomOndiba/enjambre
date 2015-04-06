<?php

/**
 * Página que invoca la vista que imprime el listado de convocatorias inactivas
 */

elgg_load_css("coordinacion");

$params = array();
$content.= elgg_view('convocatorias/listar_inactivas', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
