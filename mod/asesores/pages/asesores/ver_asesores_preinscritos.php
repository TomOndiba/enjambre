<?php

elgg_load_css("coordinacion");

$title = "Listado de asesores preinscritos al banco";
$content = elgg_view('asesores/ver_asesores_preinscritos', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());